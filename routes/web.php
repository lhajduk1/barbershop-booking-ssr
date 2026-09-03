<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

// Authentication
Route::middleware('guest')->group(function (): void {
    Route::view('/register', 'auth.register');
    Route::post('/register', RegisterController::class)->name('register');

    Route::view('/login', 'auth.login');
    Route::post('/login', LoginController::class)->name('login');
});

Route::post('/logout', LogoutController::class)->name('logout')->middleware('auth');

// Email verification
Route::middleware(['auth'])
    ->prefix('email')
    ->as('verification.')
    ->group(function (): void {
        Route::get('/verify', [EmailVerificationController::class, 'notice'])->name('notice');
        Route::get('/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware('signed')->name('verify');
        Route::post('/verification-notification', [EmailVerificationController::class, 'send'])->middleware('throttle:6,1')->name('send');
    });
//

Route::get('/', fn (): View => view('welcome'));

Route::get('/dashboard', fn (): string => 'Dashboard')->middleware('auth', 'verified');
