<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;

// Gộp route cho cả Product và Category
Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);
