<?php

use App\Http\Controllers\KeranjangController;
use Illuminate\Support\Facades\Route;

Route::get('/', [KeranjangController::class, 'index']);
Route::get('/keranjang', [KeranjangController::class, 'keranjang']);
Route::post('/keranjang/tambah/{id}', [KeranjangController::class, 'tambah']);
Route::post('/keranjang/ubah/{id}', [KeranjangController::class, 'ubah']);
Route::post('/keranjang/hapus/{id}', [KeranjangController::class, 'hapus']);
Route::post('/keranjang/kosongkan', [KeranjangController::class, 'kosongkan']);