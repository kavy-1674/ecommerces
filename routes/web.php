<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('/view-carts', [CartController::class, 'viewCarts'])->name('view.carts');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');
Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity']);


Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'login'])->name('login.form');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
    Route::get('/forget-password', [AuthController::class, 'forgetPassword'])->name('password.request');
    Route::get('/register', [AuthController::class, 'register'])->name('register.form');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');

});

Route::middleware('auth')->group(function () {
    
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboards');
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');  

    Route::get('/add-product', [ProductController::class, 'addProduct'])->name('admin.add-product');
    Route::post('/store-product', [ProductController::class, 'storeProduct'])->name('admin.store-product');
    Route::get('/product-manage', [ProductController::class, 'productManage'])->name('admin.product-manage');
    Route::get('/products/filter', [ProductController::class, 'filter']);

    Route::get('/checkout', [CartController::class, 'checkOut'])->name('checkout');
    Route::post('/checkout/place-order', [CartController::class, 'placeOrder'])->name('checkout.place-order');

});
