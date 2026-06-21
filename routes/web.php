<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\User\FavoriteController;

Route::get('/', function () {
    return redirect('/products');
});

Route::get('/products', [ProductController::class,'index'])->name('user.product.index');

Route::prefix('p')->name('product.')->group(function () {
    Route::get('/{slug}', [ProductController::class, 'show'])->name('show');
});

Route::get('/dashboard', function () {
    return view('user.dashboard');
});

Route::get('/favorites', [FavoriteController::class, 'index'])->name('user.favorites.index');

Route::post('/favorites/toggle', [FavoriteController::class, 'toggle'])->name('user.favorites.toggle');

Route::post('/favorites/clear', [FavoriteController::class, 'clearAll'])->name('user.favorites.clear');

Route::get('/profile', function () {
    return view('profile.show');
});

Route::prefix('c')->name('categories.')->group(function () {
   Route::get('/{slug}', [CategoryController::class, 'index'])->name('index');
});

require __DIR__.'/auth.php';
