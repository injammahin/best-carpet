<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductRangeController;
use App\Http\Controllers\Admin\ProductSizeOptionController;
use App\Http\Controllers\Admin\QuoteRequestController as AdminQuoteRequestController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\QuoteRequestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::name('frontend.')->group(function () {
    Route::get('/', [PageController::class, 'home'])->name('home');

    Route::get('/products', [PageController::class, 'products'])->name('products');

    Route::post('/quick-quote', [QuoteRequestController::class, 'quickStore'])
        ->name('quick-quote.store');

    Route::post('/free-measure-quote', [QuoteRequestController::class, 'store'])
        ->name('quote-requests.store');

    Route::get('/mobile-showroom', [PageController::class, 'mobileShowroom'])->name('mobile-showroom');
    Route::get('/free-measure-quote', [PageController::class, 'quote'])->name('quote');
    Route::get('/about-us', [PageController::class, 'aboutUs'])->name('about-us');
    Route::get('/inspiration', [PageController::class, 'inspiration'])->name('inspiration');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');

    /*
    |--------------------------------------------------------------------------
    | Smart product route
    |--------------------------------------------------------------------------
    | /products/carpet = category listing
    | /products/aurora-nylon-carpet-range = product details
    |--------------------------------------------------------------------------
    */
    Route::get('/products/{slug}', [PageController::class, 'productShow'])->name('product.show');
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

        /*
        |--------------------------------------------------------------------------
        | Products
        |--------------------------------------------------------------------------
        */

        Route::resource('products', ProductRangeController::class);

        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        Route::resource('product-categories', ProductCategoryController::class);

        /*
        |--------------------------------------------------------------------------
        | Area Sizes
        |--------------------------------------------------------------------------
        */

        Route::resource('product-sizes', ProductSizeOptionController::class);

        /*
        |--------------------------------------------------------------------------
        | Quote Requests
        |--------------------------------------------------------------------------
        */

        Route::get('/quote-requests', [AdminQuoteRequestController::class, 'index'])
            ->name('quote-requests.index');

        Route::get('/quote-requests/{quoteRequest}', [AdminQuoteRequestController::class, 'show'])
            ->name('quote-requests.show');

        Route::patch('/quote-requests/{quoteRequest}/status', [AdminQuoteRequestController::class, 'updateStatus'])
            ->name('quote-requests.status');

        Route::patch('/quote-requests/{quoteRequest}/mark-unread', [AdminQuoteRequestController::class, 'markUnread'])
            ->name('quote-requests.mark-unread');

        Route::delete('/quote-requests/{quoteRequest}', [AdminQuoteRequestController::class, 'destroy'])
            ->name('quote-requests.destroy');

        /*
        |--------------------------------------------------------------------------
        | Reviews
        |--------------------------------------------------------------------------
        */

        Route::resource('reviews', ReviewController::class);

        /*
        |--------------------------------------------------------------------------
        | FAQs
        |--------------------------------------------------------------------------
        */

        Route::resource('faqs', FaqController::class);

        /*
        |--------------------------------------------------------------------------
        | Website Settings
        |--------------------------------------------------------------------------
        */

        Route::get('/settings', [SiteSettingController::class, 'edit'])
            ->name('settings.edit');

        Route::put('/settings', [SiteSettingController::class, 'update'])
            ->name('settings.update');
    });