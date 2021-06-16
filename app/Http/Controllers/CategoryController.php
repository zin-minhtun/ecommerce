<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryFilter(Request $request) {
        $input_categories = $request->input('categories'); // get input categories
        if($input_categories != null) {
            $request->session()->put('input_categories', $input_categories); // store input categories to session 
            $filtered_products = Product::whereIn('category_id', $input_categories)->get(); // filtering all products by input categories
            return view('product.allproducts', [
                'input_categories' => $input_categories,
                'filtered_products' => $filtered_products,
            ]);
        }
        return redirect('/allproducts');       
    }
}
