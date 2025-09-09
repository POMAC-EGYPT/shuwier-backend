<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Validation\Validator;

/**
 * Class GetCategoryRequest
 * @property string|null $search
 * @property int|null $per_page
 * @property string|null $type
 * @property int|null $parent_id
 */
class GetCategoryRequest extends FormRequest
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
            'search'   => 'nullable|string|max:255',
            'per_page' => 'nullable|integer|min:1',
            'type'     => 'nullable|in:parent,child',
            'parent_id' => 'nullable|integer|exists:categories,id',
        ];
    }

    /**
     * Get custom query parameters for API documentation.
     */
    public function queryParameters(): array
    {
        return [
            'search' => [
                'description' => 'Search term for filtering categories by name (Arabic or English)',
                'example' => 'تصميم',
            ],
            'per_page' => [
                'description' => 'Number of items per page for pagination (minimum 1, default 10)',
                'example' => 20,
            ],
            'type' => [
                'description' => 'Filter by category type: "parent" for main categories, "child" for subcategories',
                'example' => 'parent',
            ],
        ];
    }
}
