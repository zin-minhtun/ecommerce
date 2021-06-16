<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use App\Models\Role;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/buy{id}', [ProductController::class, 'buyProduct'])->middleware('auth')->name('buy.product');

Route::get('/', [ProductController::class, 'showProduct'])->name('show-product');
Route::get('/search', [ProductController::class, 'search']);
Route::get('/allproducts', [ProductController::class, 'allProducts'])->name('all-products');
Route::get('/show-detail/{id}', [ProductController::class, 'showDetail'])->name('show-detail');
Route::get('/order-by/{query}', [ProductController::class, 'orderBy'])->name('order-by');

Route::get('/cart', [CartController::class, 'index'])->middleware('auth')->name('cart.index');
Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->middleware('auth')->name('add-to-cart');
Route::get('/update-cart/{query}/{id}', [CartController::class, 'updateCart'])->name('update-cart');
Route::get('/remove-cart-item/{id}', [CartController::class, 'removeCartItem'])->name('remove-cart-item');
Route::get('/filter-by-category', [CategoryController::class, 'categoryFilter'])->name('filter-by-category');

Route::get('/checkout', [OrderController::class, 'checkoutCart'])->middleware('auth')->name('checkout');
Route::post('/place-order', [OrderController::class, 'confirmOrder'])->middleware('auth')->name('place-order');

Route::get('/add-to-wishlist/{product_id}', [WishlistController::class, 'addToWishlist'])->middleware('auth')->name('add.wishlist');
Route::get('/wishlist', [WishlistController::class, 'index'])->middleware('auth')->name('wishlist.index');
Route::get('/wishlist/{id}/delete', [WishlistController::class, 'deleteWishlist'])->middleware('auth')->name('wishlist.delete');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('/user', UserController::class);

    Route::resource('/tag', TagController::class);
    Route::get('/multi-tag/deleteall', [TagController::class, 'deleteMultipleTag'])->name('multi-tag.delete');
    Route::get('/tags/deleteall', [TagController::class, 'deleteAllTag'])->name('tagall.delete');

    Route::resource('/role', RoleController::class);
    Route::get('/roles/deleteall', [RoleController::class, 'deleteAllRole'])->name('roleall.delete');
    Route::post('/multi-role/deleteall', [RoleController::class, 'deleteMultipleRole'])->name('multi-role.delete');

    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard.home');
    Route::get('/report', [HomeController::class, 'report'])->name('report.home');
    Route::get('/delivery/orders', [HomeController::class, 'DelideryOrdertHome'])->name('delivery-order');

    Route::resource('order', OrderController::class);
    Route::post('/confirm/order', [OrderController::class, 'setOrderState'])->name('confirm.order');
    Route::post('/delete/order', [OrderController::class, 'deleteOrder'])->name('delete.order');

    Route::resource('product', ProductController::class);
    Route::get('/order-by/{query}', [ProductController::class, 'orderBy'])->name('order-by');
    Route::get('/ajax/gettags', [TagController::class, 'getTags'])->name('ajax.gettags');

    // Ajax Request
    Route::post('/ajax/deletetags', [TagController::class, 'DeleteMultiTags'])->name('ajax.deletetags');
    Route::get('/ajax/getreports', [ReportController::class, 'getReports'])->name('ajax.getreports');
    Route::get('/ajax/homereport', [HomeController::class, 'report'])->name('ajax.homereport');
});

// Route::get('test', function()


//     return 'ok';
// });