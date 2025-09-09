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
class StorePortfolioRequest extends FormRequest
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
            'attachments'    => 'nullable|array',
            'attachments.*'  => 'file|mimes:pdf,jpeg,jpg,png,gif,doc,docx,xls,xlsx|max:5120',
            'hashtags'       => 'nullable|array',
            'hashtags.*'     => 'string|max:255',
        ];
    }
}
