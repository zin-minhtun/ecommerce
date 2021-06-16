<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PharIo\Manifest\Author;

class WishlistController extends Controller
{
    public function addToWishlist($id)
    {
        $wishlist = Wishlist::create([
            'user_id' => Auth::user()->id,
        ]);
        $res = DB::table('product_wishlist')
            ->leftJoin('wishlists', 'product_wishlist.wishlist_id', '=', 'wishlists.id')
            ->where('user_id', Auth::user()->id)
            ->where('product_id', $id)
            ->get();
        if (count($res) == 0) {
            $wishlist->getProducts()->attach([$id]);
        } else {
            $wishlist->getProducts()->detach([$id]);
            Wishlist::destroy($wishlist->id);
        }
        return back();
    }

    public function deleteWishlist($wishlist_id)
    {
        $wishlist = Wishlist::find($wishlist_id);
        $product = $wishlist->getProductswithTrashed->first();
        if ($product->trashed()) {
            // dd('trashed');
            $wishlist->delete();
            $product->forceDelete();
        } else {
            // dd('not trash item');
            $wishlist->delete();
        }
        return back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wishlist_items = Wishlist::where('user_id', Auth::user()->id)->get();
        return view('wishlist', ['wishlist_items' => $wishlist_items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function show(Wishlist $wishlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function edit(Wishlist $wishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wishlist $wishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wishlist $wishlist)
    {
        //
    }
}
