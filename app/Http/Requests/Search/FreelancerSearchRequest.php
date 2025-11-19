<?php

namespace App\Http\Requests\Search;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Validation\Validator;

/**
 * @property string|null $search
 * @property array|null $category_ids
 * @property array|null $skill_ids
 * @property array|null $rates
 * @property int|null $per_page
 */
class FreelancerSearchRequest extends FormRequest
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
            'category_ids.*' => 'required|exists:categories,id',
            'skill_ids'      => 'nullable|array',
            'skill_ids.*'    => 'required|exists:skills,id',
            'rates'          => 'nullable|array',
            'rates.*'        => 'required|integer|min:1',
            'per_page'       => 'nullable|integer|min:1|max:50',
        ];
    }
}
