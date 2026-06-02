<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Frontend\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::name('frontend.')->group(function () {
    Route::get('/', [PageController::class, 'home'])->name('home');

    Route::get('/products', [PageController::class, 'products'])->name('products');
    Route::get('/products/{slug}', [PageController::class, 'productShow'])->name('product.show');

    Route::get('/mobile-showroom', [PageController::class, 'mobileShowroom'])->name('mobile-showroom');
    Route::get('/free-measure-quote', [PageController::class, 'quote'])->name('quote');
    Route::get('/inspiration', [PageController::class, 'inspiration'])->name('inspiration');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
});

/*
|--------------------------------------------------------------------------
| Admin Auth Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])
        ->middleware('guest')
        ->name('login');

    Route::post('/login', [AdminAuthController::class, 'login'])
        ->middleware('guest')
        ->name('login.submit');

    Route::post('/logout', [AdminAuthController::class, 'logout'])
        ->middleware('auth')
        ->name('logout');
});

/*
|--------------------------------------------------------------------------
| Protected Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');
    });