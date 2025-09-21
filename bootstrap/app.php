<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::prefix('api/admin')->as('admin.')
                ->group(base_path('routes/admin.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'auth.any'                => \App\Http\Middleware\AuthenticateAnyGuard::class,
            'checkUserType'           => \App\Http\Middleware\CheckUserType::class,
            'checkFreelancerApproval' => \App\Http\Middleware\CheckFreelancerApproval::class,
        ]);
        $middleware->append([
            \App\Http\Middleware\Lang::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            return Response::api(__('message.not_found'), 404, false, 404);
        });
        // Custom unauthenticated handling for multiple guards
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->is('api/*')) {
                return Response::api(__('message.unauthenticated'), 401, false, 401);
            }
        });
        $exceptions->render(function (TooManyRequestsHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return Response::api(__('message.too_many_requests'), 429, false, 429);
            }
        });
    })->create();
