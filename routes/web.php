<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

Route::prefix('api')->group(function () {
    Route::get('/about-us', [ApiController::class, 'getAboutUs'])->name('about-us.get');
    Route::get('/member', [ApiController::class, 'getMember'])->name('member.get');
    Route::get('/organization', [ApiController::class, 'getOrganization'])->name('organization.get');
    Route::get('/product-category', [ApiController::class, 'getCategory'])->name('product-category.get');
    Route::get('/service', [ApiController::class, 'getService'])->name('service.get');
    Route::get('/product', [ApiController::class, 'getProduct'])->name('product.get');
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
