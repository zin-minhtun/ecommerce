<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        // retrieve total_no:_of_product_quantity inside cart when rendering each blade  
        View::composer('*', function($view) {
            if(Auth::check()){
                // get cart items with current user
                $cart_items = Cart::where('user_id', Auth::user()->id)->where('state', 'active')->get();
                
                $orders = Order::where('state', null)->get();

                $products = Product::all();
                $view->with('total_products', count($products));

                $total_users = User::where('id', '!=', Auth::user()->id)->get()->count();
                $view->with('total_users', $total_users);

                $new_orders = count($orders);
                if($new_orders > 0){
                    $view->with('has_neworder', true)
                         ->with('new_orders', $new_orders);
                }

                // total no: of product quantity inside cart
                $total_cart_item = 0;
                foreach($cart_items as $cart_item){
                    $total_cart_item = $cart_item->quantity + $total_cart_item; 
                }
                if($total_cart_item > 0){
                    $view->with('total_cart_item', $total_cart_item)
                         ->with('cart_items', $cart_items);
                }
            }
        });

        // 
        View::composer(['product.allproducts', 'admin.product.edit'], function($view) {
            $categories = Category::all();
            $view->with('categories', $categories);
        });
    }
}
