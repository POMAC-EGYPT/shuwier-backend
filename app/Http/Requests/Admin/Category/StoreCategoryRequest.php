<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Validation\Validator;

/**
 * Class StoreCategoryRequest
 * @property string $name_ar
 * @property string $name_en
 * @property int|null $parent_id
 * @property \Illuminate\Http\UploadedFile|null $image
 */
class StoreCategoryRequest extends FormRequest
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
            'name_en'   => 'required|string|max:255',
            'name_ar'   => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'image'     => request()->routeIs('admin.categories.store') ? 'required_if:parent_id,null|file|mimes:svg,png|max:2048' : 'nullable|mimes:svg,png|max:2048',
        ];
    }

    /**
     * Get custom body parameters for API documentation.
     */
    public function bodyParameters(): array
    {
        return [
            'name_en' => [
                'description' => 'Category name in English (required, max 255 characters)',
                'example' => 'Web Development',
            ],
            'name_ar' => [
                'description' => 'Category name in Arabic (required, max 255 characters)',
                'example' => 'تطوير المواقع',
            ],
            'parent_id' => [
                'description' => 'Parent category ID for creating subcategories (optional)',
                'example' => 1,
            ],
            'image' => [
                'description' => 'Category image file (required for creation, optional for update). Must be an SVG file, max 2MB.',
                'example' => 'No-example',
            ],
        ];
    }
}
