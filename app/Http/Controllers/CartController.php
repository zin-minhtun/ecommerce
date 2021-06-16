<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index() {
        $current_user_id = Auth::user()->id;
        $cart_items = Cart::where('user_id', $current_user_id)->where('state', 'active')->get();
        // dd();
        // if($cart_items[0]->getProduct->first()->getTags->first() != null) {
        //     dd('true');
        // }else {
        //     dd('false');
        // }
        // $check_tag = $cart_items[0]->getProduct->first()->getTags->first();
        return view('product.cart', ['cart_items' => $cart_items]);
    }

    public function updateCart($query, $cart_id) {
        $cart_item = Cart::find($cart_id);
        if($query == 'inc'){
            $cart_item->quantity += 1; 
            $cart_item->save();
        }else {
            $cart_item->quantity -= 1; 
            $cart_item->save();
        }
        return back();
    }

    public function removeCartItem($product_id) {
        Cart::destroy($product_id);
        return back()->with('success', 'Successfully removed from cart.');
    }

    public function addToCart(Request $request, $product_id) {
        $duplicated_cart_items = DB::table('carts')
                            ->rightJoin('product_cart', 'carts.id', '=', 'product_cart.cart_id')
                            ->where('user_id', Auth::user()->id)
                            ->where('product_id', $product_id)
                            ->where('state', 'active')
                            ->get();
        if(count($duplicated_cart_items) > 0) {
            // Update quantity if there any duplicated cart items.
            $update_item = Cart::find($duplicated_cart_items->first()->cart_id);
            $update_item->quantity += $request->quantity;
            $update_item->save();
        }else {
            $cart = Cart::create($request->only(['user_id', 'quantity']));
            DB::table('product_cart')->insert([
                'product_id' => $product_id,
                'cart_id' => $cart->id,
            ]);
        }
        return back()->with('status', 'Successfully added to cart.');
    }
}
