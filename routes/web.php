<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::put('/categories', [AdminController::class, 'updateCategories'])->name('categories.update');
    Route::get('/products/{slug}/edit', [AdminController::class, 'editProduct'])->name('products.edit');
    Route::put('/products/{slug}', [AdminController::class, 'updateProduct'])->name('products.update');
});
