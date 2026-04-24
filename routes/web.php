<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // About Page
    Route::get('/about', [AboutController::class, 'index'])->name('about');

    // Product CRUD
    Route::resource('product', ProductController::class);

    // Category CRUD (Admin Only)
    Route::resource('category', App\Http\Controllers\CategoryController::class)->middleware('can:manage-category');
});

require __DIR__.'/auth.php';
