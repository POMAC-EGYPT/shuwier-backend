<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Validation\Validator;

/**
 * @property string   $name_ar
 * @property string   $name_en
 * @property int|null $category_id
 */
class SkillRequest extends FormRequest
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
            'name_ar'     => 'required|string|max:255',
            'name_en'     => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
        ];
    }

    /**
     * Get custom body parameters for API documentation.
     *
     * @return array<string, array<string, mixed>>
     */
    public function bodyParameters(): array
    {
        return [
            'name_ar' => [
                'description' => 'The Arabic name of the skill. Must be unique and between 1-255 characters.',
                'example' => 'برمجة PHP',
            ],
            'name_en' => [
                'description' => 'The English name of the skill. Must be unique and between 1-255 characters.',
                'example' => 'PHP Programming',
            ],
            'category_id' => [
                'description' => 'The ID of the category this skill belongs to. Must exist in the categories table.',
                'example' => 2,
            ],
        ];
    }
}
