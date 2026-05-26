<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/products');
});

Route::get('/products', function () {
    return view('user.products.index');
});

Route::get('/products/{id}', function ($id) {
    return view('user.products.show', compact('id'));
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

require __DIR__.'/auth.php';
