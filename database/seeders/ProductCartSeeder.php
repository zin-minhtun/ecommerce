<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductCartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carts = Cart::all();
        $products = Product::all();

        $carts->each(function($cart,$key)use($products){
            $cart->getProduct()->attach($products->random(1)->pluck('id'));
        });
    }
}
