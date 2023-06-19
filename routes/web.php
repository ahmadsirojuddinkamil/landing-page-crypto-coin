<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);

Route::get('/about', function () {
    return view('pages.blog.about.index');
});

Route::get('/contact', function () {
    return view('pages.blog.contact.index');
});

Route::middleware('auth')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index');
    });

    Route::controller(PostController::class)->group(function () {
        Route::resource('/post', PostController::class);
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
