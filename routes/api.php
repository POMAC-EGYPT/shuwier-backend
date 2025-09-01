<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::group(['middleware' => 'lang', 'prefix' => 'auth'], function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/resend-code', [AuthController::class, 'resendCode'])->name('resend-code');
    Route::post('/verify-email', [AuthController::class, 'verifyEmail'])->name('verify-email');
    Route::post('/reset-email', [AuthController::class, 'resetEmail'])->name('reset-email');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/forget-password', [AuthController::class, 'forgetPassword'])->name('forget-password');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->middleware('auth.any:api,admin')->name('logout');

    Route::post('/refresh', [AuthController::class, 'refresh'])
        ->middleware('auth.any:api,admin')->name('refresh');
});
