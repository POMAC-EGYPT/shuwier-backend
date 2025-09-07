<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Validation\Validator;

/**
 * Summary of StoreAllCategoryWithChildrensRequest
 * This request is used to validate the data for creating a category with its children.
 * @property string $name_en
 * @property string $name_ar
 * @property array|null $childrens
 */
class StoreAllCategoryWithChildrensRequest extends FormRequest
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
            'name_en'             => 'required|string|max:255',
            'name_ar'             => 'required|string|max:255',
            'childrens'           => 'nullable|array',
            'childrens.*.name_en' => 'required|string|max:255',
            'childrens.*.name_ar' => 'required|string|max:255',
        ];
    }

    /**
     * Get custom body parameters for API documentation.
     */
    public function bodyParameters(): array
    {
        return [
            'name_en' => [
                'description' => 'Parent category name in English (required, max 255 characters)',
                'example' => 'Programming',
            ],
            'name_ar' => [
                'description' => 'Parent category name in Arabic (required, max 255 characters)',
                'example' => 'برمجة',
            ],
            'childrens' => [
                'description' => 'Array of child categories (optional). Each child must have name_en and name_ar.',
                'example' => [
                    [
                        'name_en' => 'Web Development',
                        'name_ar' => 'تطوير المواقع'
                    ],
                    [
                        'name_en' => 'Mobile Development',
                        'name_ar' => 'تطوير الجوال'
                    ]
                ],
            ],
            'childrens.*.name_en' => [
                'description' => 'Child category name in English (required if childrens array is provided)',
                'example' => 'Web Development',
            ],
            'childrens.*.name_ar' => [
                'description' => 'Child category name in Arabic (required if childrens array is provided)',
                'example' => 'تطوير المواقع',
            ],
        ];
    }
}
