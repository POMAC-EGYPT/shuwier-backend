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
class FreelancerHomeRequest extends FormRequest
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
            'per_page'       => 'nullable|integer|min:1',
        ];
    }
}
