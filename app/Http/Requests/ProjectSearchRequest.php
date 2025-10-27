<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Validation\Validator;

/**
 * @property string|null $search
 * @property array|null $category_ids
 * @property array|null $budgets
 * @property int|null $per_page
 */
class ProjectSearchRequest extends FormRequest
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
            'search'         => 'nullable|string|max:255',
            'category_ids'   => 'nullable|array',
            'category_ids.*' => 'required|integer|exists:categories,id',
            'budgets'        => 'nullable|array',
            'budgets.*'      => 'required|string',
            'per_page'       => 'nullable|integer|min:1|max:50',
        ];
    }

    /**
     * Get the body parameters for API documentation.
     *
     * @return array
     */
    public function bodyParameters(): array
    {
        return [
            'search' => [
                'description' => 'Search term to filter projects by title, description, or keywords. Use this to find projects that match specific skills or technologies.',
                'example' => 'website development',
            ],
            'category_ids' => [
                'description' => 'Array of category IDs to filter projects by specific categories. Only projects belonging to these categories will be returned.',
                'example' => [4, 2],
            ],
            'budgets' => [
                'description' => 'Array of budget ranges to filter projects by client budget. Use predefined budget ranges to find projects within your preferred price range.',
                'example' => ['$500-$1000', '$1000-$2000'],
            ],
            'per_page' => [
                'description' => 'Number of projects to return per page for pagination. Maximum allowed is 50, default is 10.',
                'example' => 15,
            ],
        ];
    }
}
