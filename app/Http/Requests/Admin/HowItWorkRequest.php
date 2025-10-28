<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Validation\Validator;

/**
 * Class HowItWorkRequest
 * @property string $title_en
 * @property string $title_ar
 * @property string $description_en
 * @property string $description_ar
 * @property string $type
 * @property \Illuminate\Http\UploadedFile|null $image
 */
class HowItWorkRequest extends FormRequest
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
            'title_en'       => 'required|string|max:255',
            'title_ar'       => 'required|string|max:255',
            'description_en' => 'required|string|max:5000',
            'description_ar' => 'required|string|max:5000',
            'type'           => 'required|in:freelancer,client',
            'image'          => request()->routeIs('admin.how-it-works.store') ? 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048' : 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'title_en' => [
                'description' => 'Title in English (required, max 255 characters)',
                'example'     => 'How It Works for Freelancers',
            ],
            'title_ar' => [
                'description' => 'Title in Arabic (required, max 255 characters)',
                'example'     => 'كيف يعمل للمستقلين',
            ],
            'description_en' => [
                'description' => 'Description in English (required)',
                'example'     => 'This section explains how freelancers can use the platform to find work and get paid.',
            ],
            'description_ar' => [
                'description' => 'Description in Arabic (required)',
                'example'     => 'يشرح هذا القسم كيف يمكن للمستقلين استخدام المنصة للعثور على عمل والحصول على أجر.',
            ],
            'type' => [
                'description' => 'Type of user the entry is for (required, either freelancer or client)',
                'example'     => 'freelancer',
            ],
            'image' => [
                'description' => 'An optional image illustrating the how-it-works step (image file, max 2MB)',
                'example'     => 'No-example',
            ],
        ];
    }
}
