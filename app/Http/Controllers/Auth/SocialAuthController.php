<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Implementations\Auth\Social\Context\SocialContext;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    protected $socialContext;

    public function __construct(SocialContext $socialContext)
    {
        $this->socialContext = $socialContext;
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
        $validator = Validator::make($request->all(), [
            'state' => 'required|string|in:login,register'
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $result = $this->socialContext->callback($provider, $request->state);

        if (!$result['status'])
            return Response::api($result['message'], $result['error_num'], false, $result['error_num']);

        return Response::api($result['message'], 200, true, 200, $result['data']);
    }
}
