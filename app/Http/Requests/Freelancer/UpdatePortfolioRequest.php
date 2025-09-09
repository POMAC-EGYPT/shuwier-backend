<?php

namespace App\Http\Requests\Freelancer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Validation\Validator;

/**
 * @property string $title
 * @property string $description
 * @property int $category_id
 * @property int|null $subcategory_id
 * @property array|null $attachments
 * @property array|null $hashtags
 */
class UpdatePortfolioRequest extends FormRequest
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
            'title'          => 'required|string|max:255',
            'description'    => 'required|string',
            'category_id'    => 'required|integer|exists:categories,id',
            'subcategory_id' => 'nullable|integer|exists:categories,id',
            'attachments'    => 'nullable|array|max:8',
            'attachments.*'  => function ($attribute, $value, $fail) {
                if (is_string($value)) {
                    if (strlen($value) > 255) {
                        $fail(__('validation.file_path_too_long'));
                    }
                } elseif ($value instanceof \Illuminate\Http\UploadedFile) {
                    $allowedMimes = ['pdf', 'jpeg', 'jpg', 'png', 'gif', 'doc', 'docx', 'xls', 'xlsx'];
                    $maxSize = 5120;

                    if (!in_array($value->getClientOriginalExtension(), $allowedMimes)) {
                        $fail(__('validation.mimes', ['values' => 'pdf, jpeg, jpg, png, gif, doc, docx, xls, xlsx']));
                    }

                    if ($value->getSize() > ($maxSize * 1024)) {
                        $fail(__('validation.max.file', ['max' => '5MB']));
                    }
                } else {
                    $fail(__('validation.attachment_invalid_type'));
                }
            },
            'hashtags'       => 'nullable|array',
            'hashtags.*'     => 'string|max:255',
        ];
    }
}
