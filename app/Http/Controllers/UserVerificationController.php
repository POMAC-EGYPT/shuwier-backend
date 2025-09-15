<?php

namespace App\Http\Controllers;

use App\Services\Contracts\UserVerificationServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class UserVerificationController extends Controller
{
    protected $userVerificationService;

    public function __construct(UserVerificationServiceInterface $userVerificationService)
    {
        $this->userVerificationService = $userVerificationService;
    }

    public function sendRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'document_one' => 'required|file|mimes:png,jpg,jpeg,webp,pdf|max:2048',
            'document_two' => 'sometimes|nullable|file|mimes:png,jpg,jpeg,webp,pdf|max:2048',
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $result = $this->userVerificationService->create([
            'user_id'      => auth('api')->id(),
            'document_one' => $request->document_one,
            'document_two' => $request->document_two,
        ]);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null);
    }
}
