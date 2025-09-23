<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Validation\Validator;

/**
 * @property \Illuminate\Http\UploadedFile $file
 * @property string $type
 */
class UploadFileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            Response::api($validator->errors()->first(), 400, false, 400)
        );
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'file' => 'required|file|mimes:pdf,jpeg,jpg,png,webp,doc,docx,xls,xlsx|max:5120',
            'type' => 'required|string|in:portfolio,service',
        ];
    }

    /**
     * Get the body parameters for Scribe documentation.
     */
    public function bodyParameters(): array
    {
        return [
            'file' => [
                'description' => 'The file to upload (PDF, JPEG, JPG, PNG, GIF, DOC, DOCX, XLS, XLSX, max 5MB)',
                'example' => 'No-example'  // This tells Scribe not to generate an example
            ],
            'type' => [
                'description' => 'The upload type. Currently supports: portfolio, profile_picture, document, cv, certificate',
                'example' => 'portfolio'
            ]
        ];
    }
}
