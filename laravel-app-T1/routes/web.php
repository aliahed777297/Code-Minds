<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InvoiceController;

Route::view('/', 'home.index')->name('home');
// Services listing moved to its own route (separate from home page data)
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');

Route::get('/service/{id}', [ServiceController::class, 'show'])->name('service.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');
Route::post('/cart/{id}/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/{id}/remove', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/order/confirm', [OrderController::class, 'confirm'])->name('order.confirm');
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');

Route::get('/invoice/{id}', [InvoiceController::class, 'index'])->name('invoice.show');

// Static pages
Route::get('/about', function () { return view('about.index'); })->name('about');
Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');
Route::get('/admin/contact-messages', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact.admin');
