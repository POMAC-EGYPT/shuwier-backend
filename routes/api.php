<?php

use App\Http\Controllers\UserVerificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Client\ProjectController;
use App\Http\Controllers\Client\ProposalController as ClientProposalController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\Freelancer\ProposalController;
use App\Http\Controllers\Freelancer\PortfolioController;
use App\Http\Controllers\Freelancer\ServiceController as FreelancerServiceController;
use App\Http\Controllers\HashtagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController as ControllersProjectController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\PortfolioController as GuestPortfolioController;
use App\Http\Controllers\TipsAndGuidController;
use Laravel\Socialite\Socialite;

Route::group(['prefix' => 'auth'], function () {
    Route::post('/check-register', [AuthController::class, 'checkRegisterFields'])->name('check-register');
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
    Route::post('/profile', [AuthController::class, 'updateProfile'])->name('profile.update')->middleware('auth:api');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth.any:api,admin')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth.any:api,admin')->name('refresh');
});
Route::middleware('web')->get('/auth/redirect', function () {
    $url = Socialite::driver('google')->redirect()->getTargetUrl();

    return response()->json([
        'url' => $url
    ]);
});

Route::middleware('web')->get('/auth/callback', function () {
    dd(true);
});


Route::middleware(['auth:api', 'checkUserType:freelancer', 'checkFreelancerApproval'])

    ->prefix('freelancers')->group(function () {
        Route::apiResource('portfolios', PortfolioController::class)->except('show');


        Route::apiResources(
            [
                'services' => FreelancerServiceController::class,
                'proposals' => ProposalController::class,
            ],
            [
                'middleware' => 'checkBlueMark',
            ]
        );
    });

Route::middleware(['auth:api', 'checkUserType:client', 'checkBlueMark'])->prefix('clients')->group(function () {
    Route::apiResources(
        [
            'projects' => ProjectController::class,
        ],
        [
            'except' => 'show'
        ]
    );

    Route::prefix('projects')->group(function () {
        Route::post('/{id}/end', [ProjectController::class, 'endProject'])->name('projects.end');
        Route::get('/{projectId}/proposals', [ClientProposalController::class, 'index'])->name('projects.proposals.index');
    });

    Route::get('/proposals/{id}', [ClientProposalController::class, 'show'])->name('proposals.show');
});

Route::post('/upload', [UploadFileController::class, 'upload'])
    ->middleware('auth:api')->name('file.upload');

Route::post('/verifications', [UserVerificationController::class, 'sendRequest'])
    ->middleware('auth:api')->name('user.verification.sendRequest');


// guest mode routes
Route::get('/profile/{username}', [ProfileController::class, 'profile'])->name('profile');

Route::get('/services/{id}', [ServiceController::class, 'show'])->name('services.show');

Route::get('/projects/{id}', [ControllersProjectController::class, 'show'])->name('projects.show');

Route::get('/portfolios/{id}', [GuestPortfolioController::class, 'show'])->name('portfolios.show');

Route::group(['prefix' => 'search'], function () {
    Route::get('/service', [SearchController::class, 'serviceSearch'])->name('search');
    Route::get('/project', [SearchController::class, 'projectSearch'])->name('search.project');
    Route::get('/client', [SearchController::class, 'clientSearch'])->name('search.client');
    Route::get('/freelancer', [SearchController::class, 'freelancerSearch'])->name('search.freelancer');
});

Route::group(['prefix' => 'home'], function () {
    Route::get('/guest', [HomeController::class, 'guestHome'])->name('home.guest');
    // Route::get('/client', [HomeController::class, 'clientHome'])->middleware(['auth:api', 'checkUserType:client'])->name('home.client');
});

Route::prefix('/tips-and-guides')->group(function () {
    Route::get('/', [TipsAndGuidController::class, 'index'])->name('tips-and-guides.index');
    Route::get('/{id}', [TipsAndGuidController::class, 'show'])->name('tips-and-guides.show');
});

// front utils
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

Route::get('/commissions', [CommissionController::class, 'index'])->name('commissions.index');
