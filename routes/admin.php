<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\FreelancerController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::apiResources([
    'freelancers' => FreelancerController::class,
], [
    'middleware' => ['auth:admin']
]);

Route::group(['prefix' => 'freelancers', 'middleware' => 'auth:admin'], function () {
    Route::post('/approve-reject/{id}', [FreelancerController::class, 'approveAndReject']);
});

Route::get('/freelancers-requested', [FreelancerController::class, 'requestedFreelancers']);
