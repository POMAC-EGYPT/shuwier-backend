<?php

namespace App\Providers;

use App\Repository\Contracts\UserRepositoryInterface;
use App\Repository\Eloquent\UserRepository;
use App\Services\Contracts\AuthUserServiceInterface;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use App\Services\Contracts\EmailVerificationServiceInterface;
use App\Services\Contracts\LoginServiceInterface;
use App\Services\Implementations\AuthUserService;
use App\Services\Implementations\EmailVerificationService;
use App\Services\Implementations\LoginService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EmailVerificationServiceInterface::class, EmailVerificationService::class);
        $this->app->bind(LoginServiceInterface::class, LoginService::class);
        $this->app->bind(AuthUserServiceInterface::class, AuthUserService::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Response::macro(
            'api',
            function ($message, $statusCode = 200, $status = true, $errorNum = null, $data = null) {
                $responseData = [
                    'status' => $status,
                    'error_num' => $errorNum,
                    'message' => $message,
                ];

                if ($data) {
                    if (is_object($data) && get_class($data) === 'App\Http\Resources\BaseResource') {
                        $resourceData = $data->toArray(request());

                        if (isset($resourceData['data']) && isset($resourceData['current_page']))
                            $responseData = array_merge($responseData, $resourceData);
                        else
                            $responseData['data'] = $resourceData;
                    } else {
                        $responseData['data'] = $data;
                    }
                }

                return response()->json($responseData, $statusCode);
            }
        );
    }
}
