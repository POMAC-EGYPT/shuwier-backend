<?php

use App\Http\Controllers\UserVerificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Freelancer\PortfolioController;
use App\Http\Controllers\HashtagController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\UploadFileController;

Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/resend-code', [AuthController::class, 'resendCode'])->name('resend-code');
    Route::post('/verify-email', [AuthController::class, 'verifyEmail'])->name('verify-email');
    Route::post('/reset-email', [AuthController::class, 'resetEmail'])->name('reset-email');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/forget-password', [AuthController::class, 'forgetPassword'])->name('forget-password');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('change-password')->middleware('auth:api');
    Route::post('/change-email', [AuthController::class, 'changeEmail'])->name('change-email')->middleware('auth:api');
    Route::post('/verify-change-email', [AuthController::class, 'verifyChangeEmail'])->name('verify-change-email')->middleware('auth:api');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile')->middleware('auth:api');
    Route::post('/profile', [AuthController::class, 'updateProfile'])->name('profile.update')->middleware('auth:api');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth.any:api,admin')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth.any:api,admin')->name('refresh');
});


Route::group(['prefix' => 'freelancers'], function () {
    Route::apiResources(
        [
            'portfolios' => PortfolioController::class,
        ],
        [
            'middleware' => ['checkUserType:freelancer', 'checkFreelancerApproval'],
        ]
    );
});

Route::post('/upload', [UploadFileController::class, 'upload'])
    ->middleware('auth:api')->name('file.upload');

Route::get('/languages', [LanguageController::class, 'index'])
    ->name('languages.index');

Route::group(['prefix' => 'categories'], function () {
    Route::get('/', [CategoryController::class, 'index'])
        ->name('categories.index');

    Route::get('/child/{id}', [CategoryController::class, 'getChildCategories'])
        ->name('categories.child.index');
});

Route::get('/skills', [SkillController::class, 'index'])
    ->name('skills.index');

Route::get('/hashtags', [HashtagController::class, 'index'])
    ->name('hashtags.index');

Route::post('/verifications', [UserVerificationController::class, 'sendRequest'])
    ->middleware('auth:api')->name('user.verification.sendRequest');
