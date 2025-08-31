<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateAnyGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        foreach ($guards as $guard) {
            if (auth($guard)->check()) {

                auth()->shouldUse($guard);
                return $next($request);
            }
        }

        return FacadesResponse::api(__('message.unauthenticated'), 401, false, 401);
    }
}
