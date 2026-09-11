<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ServiceController;
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

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');

Route::get('/services/{service}/book', [BookingController::class, 'create'])->name('booking.create');
Route::post('/services/{service}/book', [BookingController::class, 'store'])->name('booking.store');
Route::get('/bookings/thank-you', [BookingController::class, 'thankYou'])->name('booking.thank-you');

Route::get('employees/{employee}/availability', [AvailabilityController::class, 'index'])->name('employees.availability');

// Admin
Route::view('admin/login', 'admin.login')->middleware('guest')->name('admin.login');

Route::middleware('admin')
    ->prefix('admin')
    ->as('admin.')
    ->group(function (): void {
        Route::view('/', 'admin.dashboard')->name('dashboard');

        Route::resource('/services', AdminServiceController::class);
    });
