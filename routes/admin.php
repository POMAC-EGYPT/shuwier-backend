<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\FreelancerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommissionController;
use App\Http\Controllers\Admin\InvitationFreelancerController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\UserVerificationController;

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::apiResources([
    'freelancers' => FreelancerController::class,
    'clients'     => ClientController::class,
    'categories'  => CategoryController::class,
    'skills'      => SkillController::class,
    'commissions' => CommissionController::class,
], [
    'middleware' => ['auth:admin']
]);
Route::post('categories/store-all-with-childrens', [CategoryController::class, 'storeAllWithChildrens'])
    ->middleware('auth:admin');

Route::group(['prefix' => 'freelancers', 'middleware' => 'auth:admin'], function () {
    Route::post('/approve-reject/{id}', [FreelancerController::class, 'approveAndReject']);
    Route::post('/block-unblock/{id}', [FreelancerController::class, 'blockAndUnblock']);
});

Route::group(['prefix' => 'clients', 'middleware' => 'auth:admin'], function () {
    Route::post('/block-unblock/{id}', [ClientController::class, 'blockAndUnblock']);
});

Route::group(['prefix' => 'verifications', 'middleware' => 'auth:admin'], function () {
    Route::get('/', [UserVerificationController::class, 'index'])->name('admin.user-verifications.index');
    Route::post('/{id}', [UserVerificationController::class, 'acceptAndReject'])->name('admin.user-verifications.send');
});

Route::group(['prefix' => 'invitations', 'middleware' => 'auth:admin'], function () {
    Route::get('/', [InvitationFreelancerController::class, 'index'])->name('admin.freelancer.invitations');
    Route::post('/', [InvitationFreelancerController::class, 'sendInvitation'])->name('admin.freelancer.invite');
});
