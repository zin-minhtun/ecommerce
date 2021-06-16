<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductPricing;
use App\Models\Tag;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;

use function GuzzleHttp\Promise\each;

class ProductController extends Controller
{

    /* Create cart and product */
    public function createCartProduct($request, $product_id)
    {
        $cart = Cart::create([
            'user_id' => $request->input('user_id'),
            'quantity' => $request->input('quantity'),
        ]);
        $cart_item = Cart::find($cart->id);
        $cart_item->state = 'direct-buy';
        $cart_item->save();
        DB::table('product_cart')->insert([
            'product_id' => $product_id,
            'cart_id' => $cart->id,
        ]);
    }

    /* Get all duplicated carts with state => direct-buy */
    public function getDuplicatedCartItems()
    {
        return DB::table('carts')
            ->rightJoin('product_cart', 'carts.id', '=', 'product_cart.cart_id')
            ->where('user_id', Auth::user()->id)
            ->where('state', 'direct-buy')
            ->get();
    }

    /* Buy Products */
    public function buyProduct(Request $request, $product_id)
    {
        $this->createCartProduct($request, $product_id);
        $results = $this->getDuplicatedCartItems();
        if (count($results) > 0) {
            $cart_id = $results->last()->cart_id;
            Cart::where('user_id', Auth::user()->id)
                ->where('state', 'direct-buy')
                ->where('id', '!=', $cart_id)
                ->delete();
        }
        $filtered_data = $this->getDuplicatedCartItems();
        return view('product.checkout', [
            'checkout_product' => [
                'product' => Product::find($filtered_data->first()->product_id),
                'quantity' => $filtered_data->first()->quantity,
            ],
            'payments' => Payment::all(),
        ]);
    }

    /**
     * For Product's OrderBy.
     * Checked for both product's OrderBy from AdminPanel and Webage.
     */
    public function orderBy($query)
    {
        $current_url = str_replace(url('/'), '', url()->current());
        $admin_url = '/admin/order-by/' . $query;
        $input_categories = Session::get('input_categories');
        // dd($admin_url);
        switch ($query) {
            case 'name':
                if ($input_categories) {
                    $filtered_products = Product::whereIn('category_id', $input_categories)->get();
                    $data = [
                        'query' => $query,
                        'input_categories' => $input_categories,
                        'orderby_name_items' => $filtered_products->sortBy('name'),
                    ];
                    return view('product.allproducts', $data);
                } else {
                    $orderby_name_items = Product::all()->sortBy('name');
                    $data = [
                        'query' => $query,
                        'orderby_name_items' => $orderby_name_items,
                    ];
                    // Checking current URL is from AdminPanel's OrderBy or WebPage's OrderBy.
                    return $current_url == $admin_url ? view('admin.product.products', $data) : view('product.allproducts', $data);
                }
                break;
            case 'price':
                if ($input_categories) {
                    $filtered_products = Product::whereIn('category_id', $input_categories)->get();
                    $data = [
                        'query' => $query,
                        'input_categories' => $input_categories,
                        'orderby_price_items' => $filtered_products->sortBy('price'),
                    ];
                    return view('product.allproducts', $data);
                } else {
                    $orderby_price_items = Product::orderBy('price', 'asc')->get();
                    $data = [
                        'query' => $query,
                        'orderby_price_items' => $orderby_price_items
                    ];
                    // Checking current URL is from AdminPanel's OrderBy or WebPage's OrderBy.
                    return $current_url == $admin_url ? view('admin.product.products', $data) : view('product.allproducts', $data);
                }
                break;
        }
    }
    /**
     * /. Product's OrderBy
     */

    /**
     * For WebPage 
     */
    // Show products on Home page.
    public function showProduct()
    {
        $shuffle_items = array();
        $products = Product::latest()->get();
        $shuffle_products = Product::get()->shuffle();
        foreach ($shuffle_products as $value) {
            $discount_item = $value->getProductPricing->first();
            if ($discount_item != null) {
                array_push($shuffle_items, $value);
            }
        }
        // dd($shuffle_items);
        return view('welcome', [
            'shuffle_items' => array_slice($shuffle_items, 0, 4),
            'products' => $products,
            'random_products' => Product::all()->take(3),
        ]);
    }

    // Show product's detail.
    public function showDetail(Product $id)
    {
        return view('product.productdetail', ['product' => $id]);
    }

    // product search
    public function search(Request $request)
    {
        if ($request->input('query') == null) {
            return redirect('/allproducts');
        } else {
            $search_query_result = Product::where('name', 'LIKE', '%' . $request->input('query') . '%')->get();
            return view('product.allproducts', [
                'search_query_result' => $search_query_result
            ]);
        }
    }

    // retrieving all products
    public function allProducts()
    {
        Session::forget('input_categories'); // need to forget input categories session before retrieving products
        $product_items = Product::latest()->get();
        return view('product.allproducts', ['product_items' => $product_items]);
    }
    /**
     * /. Webpage 
     */



    /**
     * For Admin-Panel
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::forget('input_categories');
        return view('admin.product.products', [
            'products' => Product::latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', [
            'categories' => $categories,
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->file('image'));
        $image = $request->file('image');
        $imageName = time() . '.' . $image->extension();

        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(500, 500);
        $image_resize->save(public_path('images/') . $imageName, 100);
        $product = Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'cost_price' => $request->input('cost_price'),
            'category_id' => $request->input('category_id'),
            'description' => $request->input('description'),
            'gallery' => $imageName,
        ]);

        if ($request->input('discount_percentage') != null) {
            $product->getProductPricing()->create([
                'discount_percentage' => $request->input('discount_percentage'),
                'status' => $request->input('status'),
                'product_id' => $product->id,
            ]);
        }

        $product->getTags()->attach($request->input('tags'));
        return back()->with('success', 'Successfully created.')
            ->with('image', $imageName);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Product $product)
    {
        $check_tags = array();
        foreach ($product->getTags as $value) {
            $check_tags[] = $value->id;
        }
        return view('admin/product/edit', [
            'page' => $request->input('page'),
            'product' => $product,
            'tags' => Tag::all(),
            'check_tag' => $check_tags,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function updateProduct($request, $product)
    {
        $product->update($request->except(['_token', '_method', 'image']));
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $request->file('image')->extension();
            // $img = Image::make('public/foo.jpg');

            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(500, 500);
            $image_resize->save(public_path('images/') . $imageName, 100);
            $product->gallery = $imageName;
            $product->save();
        }
        $product->getTags()->sync($request->input('tags'));
    }

    public function update(Request $request, Product $product)
    {
        $product = Product::find($product->id);

        if ($request->input('status') == null) {
            // dd($request->all());
            $product->getProductPricing()->where('product_id', $product->id)->delete();
            $this->updateProduct($request, $product);
            return back()->with('success', 'Successfully Updated.');
        } else {
            $product_pricing = ProductPricing::where('product_id', $product->id)->first();
            $this->updateProduct($request, $product);
        }
        if (isset($product_pricing)) {
            $product_pricing->update([
                'discount_percentage' => $request->input('discount_percentage'),
                'status' => $request->input('status'),
                'product_id' => $product->id,
            ]);
        } else {
            ProductPricing::create([
                'discount_percentage' => $request->input('discount_percentage'),
                'status' => $request->input('status'),
                'product_id' => $product->id,
            ]);
        }
        // $request->session()->put('previous_url', $request->input('previous_url'));
        return back()->with('success', 'Successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $wishlist_items = array();
        $confirm_products = array();

        $wishlists = Wishlist::all();
        $orders = Order::all();
        foreach ($wishlists as $wishlist) {
            array_push($wishlist_items, $wishlist->getProducts()->withTrashed()->first()->id);
        }
        foreach ($orders as $order) {
            foreach ($order->getCart as $item) {
                array_push($confirm_products, $item->getProduct->first()->id);
            }
        }
        in_array($product->id, $confirm_products) || in_array($product->id, $wishlist_items) ?
            Product::find($product->id)->delete() :
            Product::find($product->id)->forceDelete();
        return back()->with('success', 'Successfully deleted.');
    }
    /**
     * /. Admin-panel 
     */
}
