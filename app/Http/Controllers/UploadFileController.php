<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use App\Services\Upload\Context\UploadContext;
use Illuminate\Support\Facades\Response;

/**
 * @group File Upload
 * 
 * APIs for handling file uploads
 */
class UploadFileController extends Controller
{
    protected $uploadContext;

    public function __construct(UploadContext $uploadContext)
    {
        $this->uploadContext = $uploadContext;
    }

    public function upload(UploadFileRequest $request)
    {
        $result = $this->uploadContext->upload($request->type, $request->file, auth('api')->id());

        return Response::api(__('message.file_uploaded_successfully'), 200, true, null, $result);
    }
}
