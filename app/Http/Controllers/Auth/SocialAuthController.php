<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect(string $provider, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mode' => 'required|string|in:login,register'
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $url = Socialite::driver($provider)->redirect()->getTargetUrl();

        return Response::api(__('message.success'), 200, true, 200, ['url' => $url]);
    }

    public function callback(string $provider, Request $request)
    {
        $mode = $request->mode;
        dd($mode, request()->input('mode'));
        $user = Socialite::driver($provider)->user();

        return Response::api(__('message.success'), 200, true, 200, ['user' => $user]);
    }
}
