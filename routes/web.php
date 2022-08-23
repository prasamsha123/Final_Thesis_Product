<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::controller(AdminController::class)->group(function () {
    Route::get('/', 'view' );
});

Route::middleware(['auth:sanctum'])->get('/dashboard', function(){
    return view('dasboard');
})->name('dashboard'); 

Route::controller(AdminController::class)->middleware(['auth'])->group(function () {
    Route::get('/dashboard', 'view_home' );
});
require __DIR__.'/auth.php';

Route::controller(AdminController::class)->group(function () {
    Route::get('category', 'view_category');
    Route::post('add-category', 'addActivity');
    Route::get('delete-category/{id}', 'delete_category');
});

Route::controller(AdminController::class)->group(function () {
    Route::get('view-product', 'view_product');
    Route::post('add-product', 'add_product');
    Route::get('show-product', 'show_product');  
    Route::get('delete-product/{id}', 'delete_product');
    Route::get('edit-product/{id}', 'edit_product');
    Route::post('update-product/{id}', 'update_product');
});

Route::controller(AdminController::class)->group(function () {
    Route::get('product_detail/{id}', 'product_detail');
});

Route::controller(AdminController::class)->middleware(['auth'])->group(function () {
    Route::post('add-cart/{id}', 'add_cart');
    Route::get('show_cart', 'show_cart');
    Route::get('delete-cart-product/{id}', 'delete_cart_product');
});

Route::controller(AdminController::class)->middleware(['auth'])->group(function () {
    Route::get('cash-on-delivery', 'cash_on_delivery');
    Route::get('stripe/{totalprice}', 'stripe');
    Route::post('stripe/{totalprice}', 'stripePost')->name('stripe.post');
});

Route::controller(AdminController::class)->middleware(['auth'])->group(function () {
    Route::get('show_order', 'show_order');
    Route::get('order', 'order_product');
    Route::get('order-deliver/{id}', 'order_deliver');
    Route::get('search', 'search');
    Route::get('cancle_order/{id}', 'cancle_order');
});