<?php

use App\Http\Controllers\Api\FilterController;
use Illuminate\Support\Facades\Route;

Route::get('/filters', [FilterController::class, 'index']);
