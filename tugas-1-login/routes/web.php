<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;

Route::redirect('/', '/login');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'can:manage-roles'])->group(function () {
    Route::get('/admin/users', function () {
        return view('admin.users', [
            'users' => \App\Models\User::orderBy('id')->get(),
        ]);
    })->name('admin.users.index');

    Route::patch('/admin/users/{user}/role', [RoleController::class, 'update'])
        ->name('admin.users.role.update');
});

Route::middleware('auth')->get('/cart/simulasi', function () {
    return view('cart.simulasi');
})->name('cart.simulasi');

Route::post('/cart/add', function (Request $request) {
    return response()->json([
        'message' => 'Item ditambahkan (simulasi)',
        'cart'    => $request->input('cart', []),
    ]);
})->middleware(['auth', 'can:use-cart'])->name('cart.add');