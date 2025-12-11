<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Services\Contracts\Auth\SocialAuthSerivceInterface;
use App\Services\Implementations\Auth\Social\Context\SocialContext;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    protected $socialContext;
    protected $socialAuthService;

    public function __construct(SocialContext $socialContext, SocialAuthSerivceInterface $socialAuthService)
    {
        $this->socialContext = $socialContext;
        $this->socialAuthService = $socialAuthService;
    }

    public function redirect(string $provider, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'state' => 'required|string|in:login,register',
            'type'  => 'required_if:state,register|string|in:freelancer,client',
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $url = Socialite::driver($provider)
            ->with(['state' => $request->state, 'type' => $request->type])
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

    public function registerFinalize(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'temp_key' => 'required|string',
            'username' => [
                'required',
                'min:3',
                'max:20',
                'string',
                'regex:/^[A-Za-z][A-Za-z0-9_]*$/u',
                'unique:users,username',
            ],
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $result = $this->socialAuthService->finalizeRegistration(
            $request->temp_key,
            $request->username,
        );

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api(
            __('message.success'),
            200,
            true,
            200,
            [
                'user' => ClientResource::make($result['data']['user']),
                'token' => $result['data']['token']
            ]
        );
    }
}
