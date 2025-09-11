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

    /**
     * Upload file
     * 
     * Upload files for different purposes like portfolios, profile pictures, etc.
     * The uploaded file will be stored and return file information including the file path and attachment ID.
     * 
     * @bodyParam file file required The file to upload (PDF, JPEG, JPG, PNG, GIF, DOC, DOCX, XLS, XLSX, max 5MB). Example: file.jpg
     * @bodyParam type string required The upload type. Currently supports: portfolio, profile_picture, document, cv, certificate. Example: portfolio
     * 
     * @response 200 {
     *   "message": "File uploaded successfully",
     *   "status": true,
     *   "data": {
     *     "id": 15,
     *     "file_path": "storage/portfolios/66e1a5c4e8b47.jpg",
     *     "user_id": 1,
     *     "portfolio_id": null,
     *     "created_at": "2024-09-11T10:30:00.000000Z",
     *     "updated_at": "2024-09-11T10:30:00.000000Z"
     *   }
     * }
     * 
     * @response 400 {
     *   "message": "The file field is required.",
     *   "status": false,
     *   "error_code": 400
     * }
     * 
     * @response 400 {
     *   "message": "The selected type is invalid.",
     *   "status": false,
     *   "error_code": 400
     * }
     * 
     * @response 400 {
     *   "message": "The file may not be greater than 5120 kilobytes.",
     *   "status": false,
     *   "error_code": 400
     * }
     * 
     * @authenticated
     */
    public function upload(UploadFileRequest $request)
    {
        $result = $this->uploadContext->upload($request->type, $request->file, auth('api')->id());

        return Response::api(__('message.file_uploaded_successfully'), 200, true, null, $result);
    }
}
