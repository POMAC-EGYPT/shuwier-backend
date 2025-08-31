<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use App\Services\Contracts\EmailVerificationServiceInterface;
use App\Services\Contracts\LoginServiceInterface;
use App\Services\Implementation\EmailVerificationService;
use App\Services\Implementation\LoginService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EmailVerificationServiceInterface::class, EmailVerificationService::class);
        $this->app->bind(LoginServiceInterface::class, LoginService::class);
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
