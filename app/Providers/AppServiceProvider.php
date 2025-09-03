<?php

namespace App\Providers;

use App\Repository\Contracts\AdminRepositoryInterface;
use App\Repository\Contracts\FreelancerProfileRepositoryInterface;
use App\Repository\Contracts\UserRepositoryInterface;
use App\Repository\Eloquent\AdminRepository;
use App\Repository\Eloquent\FreelancerProfileRepository;
use App\Repository\Eloquent\UserRepository;
use App\Services\Contracts\Auth\AuthAdminServiceInterface;
use App\Services\Contracts\Auth\AuthUserServiceInterface;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use App\Services\Contracts\Auth\EmailVerificationServiceInterface;
use App\Services\Contracts\ClientServiceInterface;
use App\Services\Contracts\FreelancerServiceInterface;
use App\Services\Implementations\Auth\AuthAdminService;
use App\Services\Implementations\Auth\AuthUserService;
use App\Services\Implementations\Auth\EmailVerificationService;
use App\Services\Implementations\ClientService;
use App\Services\Implementations\FreelancerService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EmailVerificationServiceInterface::class, EmailVerificationService::class);

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AuthUserServiceInterface::class, AuthUserService::class);

        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(AuthAdminServiceInterface::class, AuthAdminService::class);

        $this->app->bind(FreelancerProfileRepositoryInterface::class, FreelancerProfileRepository::class);

        $this->app->bind(FreelancerServiceInterface::class, FreelancerService::class);

        $this->app->bind(ClientServiceInterface::class, ClientService::class);
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
