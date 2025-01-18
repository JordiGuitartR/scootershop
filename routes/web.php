<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProducteController;
use App\Http\Controllers\ComandaController;

// Ruta principal per a la home page
Route::get('/', [ProducteController::class, 'home'])->name('home');

Route::get('/producte/{id}', [ProducteController::class, 'show'])->name('producte.show');

Route::get('/cart', [ComandaController::class, 'cart'])->name('cart');
Route::get('/cart/add/{id}', [ComandaController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/remove/{id}', [ComandaController::class, 'removeFromCart'])->name('cart.remove');

Route::post('/cart/update/{id}/{action}', [ComandaController::class, 'updateQuantity'])->name('cart.update');

Route::put('/producte/{id}', [ProducteController::class, 'update'])->name('productes.update');


// Ruta per al dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grup de rutes protegides per autenticació
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutes d'autenticació
require __DIR__.'/auth.php';
