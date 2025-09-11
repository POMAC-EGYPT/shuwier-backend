<?php

namespace App\Http\Middleware;

use App\Enum\ApprovalStatus;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Symfony\Component\HttpFoundation\Response;

class CheckFreelancerApproval
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth('api')->user();
        
        if (!$user || $user->type !== 'freelancer' || $user->approval_status != ApprovalStatus::APPROVED)
            return FacadesResponse::api(__('message.you_are_not_approved_freelancer'), 403, false, 403);

        return $next($request);
    }
}
