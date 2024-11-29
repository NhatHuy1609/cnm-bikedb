<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Models\User;
use Illuminate\Support\Facades\App;
use App\Http\Middleware\RedirectIfVerified;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;


// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register.post');
});

// Email Verification Routes
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [AuthController::class, 'showVerifyNotice'])
        ->middleware(RedirectIfVerified::class)
        ->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verify'])
        ->middleware(['signed'])
        ->name('verification.verify');

    Route::post('/email/verification-notification', [AuthController::class, 'resend'])
        ->middleware(['throttle:6,1'])
        ->name('verification.send');

    Route::get('/check-verification-status', [AuthController::class, 'checkVerificationStatus'])
        ->middleware('auth')
        ->name('verification.check');

    // Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::delete('/account/delete', [AuthController::class, 'deleteUnverifiedAccount'])
        ->name('account.delete');
});

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        if (request()->user()->provider == 'google' || request()->user()->hasVerifiedEmail()) {
            return view('dashboard');
        }
        return redirect()->route('verification.notice');
    })->name('dashboard');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])
        ->middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])
        ->name('admin.dashboard');
    Route::get('/admin/add', [AdminController::class, 'create'])
        ->middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])
        ->name('admin.create');
    Route::post('/admin/store', [AdminController::class, 'store'])
        ->middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])
        ->name('admin.store');
});

// Preview mail route
if (App::environment('local')) {
    Route::get('/mailable/preview', function () {
        $user = User::factory()->make([
            'email' => 'test@example.com',
            'name' => 'Test User'
        ]);
        return new Illuminate\Auth\Notifications\VerifyEmail($user);
    });
}
// Password Reset Routes
Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])
    ->middleware('guest')
    ->name('password.request');

Route::post('forgot-password', [AuthController::class, 'sendResetLink'])
    ->middleware('guest')
    ->name('password.email');

Route::get('reset-password/{token}', [AuthController::class, 'showResetForm'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('reset-password', [AuthController::class, 'resetPassword'])
    ->middleware('guest')
    ->name('password.update');

Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');
