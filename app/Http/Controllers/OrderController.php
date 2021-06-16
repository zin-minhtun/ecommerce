<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderController extends Controller
{
    public function index()
    {
        $orders = array();
        $cart_orders = DB::table('cart_order')
            ->join('orders', 'cart_order.order_id', '=', 'orders.id')
            ->orderBy('state')
            ->orderBy('orders.updated_at', 'DESC')
            ->get();
        foreach ($cart_orders as $cart_order) {
            $order_info = Order::find($cart_order->order_id);
            $product_cart = DB::table('product_cart')->where('cart_id', $cart_order->cart_id)->first();
            // if(isset($product_cart)){
            $product = Product::withTrashed()->find($product_cart->product_id);
            $quantity = Cart::where('id', $cart_order->cart_id)->pluck('quantity');
            array_push($orders, [
                'order_info' => $order_info,
                'product' => $product,
                'quantity' => $quantity,
            ]);
            // }
        }
        $data = array();
        foreach ($orders as $key => $item) {
            $data[$item['order_info']->id][$key] = $item;
        }
        $arr = $this->paginate($data);
        return view('admin.product.order', ['orders' => $arr]);
    }

    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function setOrderState(Request $request)
    {
        $confirm_order_rec = Order::find($request->order_id);
        $confirm_order_rec->state = 'confirm';
        $confirm_order_rec->save();
        return back();
    }

    public function deleteOrder(Request $request)
    {
        $order = Order::find($request->order_id);
        $cart_order = DB::table('cart_order')->where('order_id', $order->id)->first();
        $product_cart = DB::table('product_cart')->where('cart_id', $cart_order->cart_id)->first();
        $product = Product::withTrashed()->find($product_cart->product_id);
        if ($product->trashed()) {
            $order->delete();
            $product->forceDelete();
        } else {
            $order->delete();
        }
        return back();
    }

    public function checkoutCart()
    {
        $payments = Payment::all();
        return view('product.checkout', [
            'payments' => $payments,
        ]);
    }

    public function createCartOrder($query, $order)
    {
        DB::table('cart_order')->insert([
            'order_id' => $order->id,
            'cart_id' => $query->id,
        ]);
        $cart_item = Cart::find($query->id);
        $cart_item->state = 'in_active';
        $cart_item->save();
        return false;
    }

    public function setOrderPricing($order)
    {
        $confirm_order_rec = Order::find($order->id);
        $total_price = 0; // Set to db
        $total_cost_price = 0; // Set to db
        $total_dis_price = 0; // Set to db
        foreach ($confirm_order_rec->getCart as $cart) {

            // dd();
            $quantity = $cart->quantity;

            $price = $cart->getProduct->first()->price;
            $total_price += $price * $quantity;

            $cost_price = $cart->getProduct->first()->cost_price;
            $total_cost_price += $cost_price * $quantity;

            if ($cart->getProduct->first()->getDiscountPrice() != null) {
                $cart = Cart::find($cart->getProduct->first()->pivot->cart_id);
                // dd($cart->getProduct->first()->pivot->cart_id);
                $total_dis_price += $cart->getProduct->first()->getDiscountPrice() * $cart->quantity;
            }else {
                $total_dis_price += $cart->getProduct->first()->price;
            }
        }
        // dd($total_price, $total_cost_price, $total_dis_price);
        $order->getProfit()->create([
            'order_id' => $order->id,
            'total_price' => $total_price,
            'total_cost_price' => $total_cost_price,
            'total_discount_price' => $total_dis_price,
        ]);
    }

    public function confirmOrder(Request $request)
    {
        $imageName = time() . '.' . $request->file('payment_receipt')->extension();
        $request->file('payment_receipt')->move(public_path('images/payment-receipt'), $imageName);
        $order = Order::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'city' => $request->input('city'),
            'address' => $request->input('address'),
            'payment_id' => $request->input('payment_id'),
            'payment_receipt' => $imageName,
        ]);
        $currentuser_cartitem = Cart::where('user_id', auth()->user()->id)->where('state', 'direct-buy')->first();
        if (isset($currentuser_cartitem)) {
            $this->createCartOrder($currentuser_cartitem, $order);
        } else {
            $currentuser_cartitems = Cart::where('user_id', auth()->user()->id)->where('state', 'active')->get();
            foreach ($currentuser_cartitems as $item) {
                $this->createCartOrder($item, $order);
            }
        }
        $this->setOrderPricing($order);
        return redirect('/')->with('paysuccess', 'Success Payment...');
    }
}
