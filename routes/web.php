<?php

use App\Http\Controllers\Homecontroller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [Homecontroller::class, 'index'])->name('home');

Route::get('/cart', [ProductsController::class, 'cart'])->name('cart.index')->middleware('auth');
Route::get('/add-to-cart/{product}', [ProductsController::class, 'addToCart'])->name('cart.add')->middleware('auth');
Route::delete('/remove-from-cart', [ProductsController::class, 'remove'])->name('remove_from_cart')->middleware('auth');
Route::resource('/products', ProductsController::class)->middleware('auth')->only(['create', 'edit', 'destroy']);
Route::resource('/products', ProductsController::class)->except(['create', 'edit', 'destroy']);

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');

});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



