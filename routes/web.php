<?php

use Dealskoo\Seller\Http\Controllers\Auth\AuthenticatedSessionController;
use Dealskoo\Seller\Http\Controllers\Auth\NewPasswordController;
use Dealskoo\Seller\Http\Controllers\Auth\PasswordResetLinkController;
use Dealskoo\Seller\Http\Controllers\Auth\RegisteredSellerController;
use Illuminate\Support\Facades\Route;

Route::prefix(config('seller.route.prefix'))->name('seller.')->group(function () {

    Route::middleware(['guest'])->group(function () {
        Route::get('/register', [RegisteredSellerController::class, 'create'])->name('register');
        Route::post('/register', [RegisteredSellerController::class, 'store'])->name('register');
        Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
        Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
        Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
        Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
        Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
    });

    Route::middleware([])->group(function () {

    });
});
