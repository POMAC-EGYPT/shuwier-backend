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

    /**
     * Submit User Verification Request
     * 
     * Submit documents for user verification. Users can upload one or two verification documents.
     * 
     * @group User Verification
    
     * @authenticated
     
     * @bodyParam document_one file required The first verification document. Must be an image (png, jpg, jpeg, webp) or PDF file, max 2MB. Example: No-example
     * @bodyParam document_two file optional The second verification document. Must be an image (png, jpg, jpeg, webp) or PDF file, max 2MB. Example: No-example
     * @response 200 {
     *   "message": "Verification request submitted successfully",
     *   "status": true,
     *   "error_num": null
     * }
     * @response 400 {
     *   "message": "The document one field is required.",
     *   "status": false,
     *   "error_num": 400
     * }
     * @response 400 {
     *   "message": "File size must not exceed 2MB",
     *   "status": false,
     *   "error_num": 400
     * }
     * @response 401 {
     *   "message": "Unauthenticated",
     *   "status": false,
     *   "error_num": 401
     * }
     */
    public function sendRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'document_one' => 'required|file|mimes:png,jpg,jpeg,webp|max:2048',
            'document_two' => 'sometimes|nullable|file|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        if (count($request->all()) > 2)
            return Response::api(__('message.invalid_fields_provided'), 400, false, 400);

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
