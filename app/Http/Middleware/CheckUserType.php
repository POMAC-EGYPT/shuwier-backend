<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Response as FacadeResponse;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $type): Response
    {
        $user = auth('api')->user();

        if (!$user || $user->type !== $type)
            return FacadeResponse::api(__('message.unauthenticated'), 401, false, 401);

        return $next($request);
    }
}
