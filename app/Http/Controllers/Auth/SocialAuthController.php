<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Contracts\Auth\AuthSocialServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    protected $authSocialService;

    public function __construct(AuthSocialServiceInterface $authSocialService)
    {
        $this->authSocialService = $authSocialService;
    }

    public function redirect(string $provider, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'state' => 'required|string|in:login,register'
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $url = Socialite::driver($provider)
            ->with(['state' => $request->state])
            ->redirect()
            ->getTargetUrl();

        return Response::api(__('message.success'), 200, true, 200, ['url' => $url]);
    }

    public function callback(string $provider, Request $request)
    {
        $result = $this->authSocialService->handleCallback($provider, $request->state);

        return Response::api(__('message.success'), 200, true, 200, ['user' => $result]);
    }
}
