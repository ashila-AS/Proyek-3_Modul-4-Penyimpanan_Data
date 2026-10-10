<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\OrderController;

Route::get('/', [ProductController::class, 'index']);

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/keranjang', [KeranjangController::class, 'index']);
    Route::post('/keranjang/tambah/{id}', [KeranjangController::class, 'tambah']);
    Route::post('/keranjang/ubah/{id}', [KeranjangController::class, 'ubah']);
    Route::post('/keranjang/hapus/{id}', [KeranjangController::class, 'hapus']);
    Route::post('/keranjang/kosongkan', [KeranjangController::class, 'kosongkan']);
    Route::get('/pesanan', [OrderController::class, 'index']);
    Route::get('/pesanan/{id}', [OrderController::class, 'show']);

    Route::post('/checkout', [CheckoutController::class, 'checkout']);
});