<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\CategoryController;

Route::get('/', function () {
    return redirect('/products');
});

Route::get('/products', [ProductController::class,'index'])->name('user.product.index');

// Route::get('/products/{id}', function ($id) {
//     return view('user.products.show', compact('id'));
// });

Route::prefix('p')->name('product.')->group(function () {
    Route::get('/{slug}', [ProductController::class, 'show'])->name('show');
});

Route::get('/dashboard', function () {
    return view('user.dashboard');
});

Route::get('/favorites', function () {
    return view('user.favorites');
});

Route::get('/profile', function () {
    return view('profile.show');
});

Route::prefix('c')->name('categories.')->group(function () {
   Route::get('/{slug}', [CategoryController::class, 'index'])->name('index');
});

require __DIR__.'/auth.php';
