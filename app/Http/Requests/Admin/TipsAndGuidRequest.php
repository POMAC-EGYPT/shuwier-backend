<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Validation\Validator;

/**
 * Class TipsAndGuidRequest
 * @property string $title_en
 * @property string $title_ar
 * @property string $description_en
 * @property string $description_ar
 * @property \Illuminate\Http\UploadedFile|null $image
 */
class TipsAndGuidRequest extends FormRequest
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
            'image'          => request()->routeIs('admin.tips-and-guides.store') ? 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048' : 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'title_en' => [
                'description' => 'Title in English (required, max 255 characters)',
                'example' => 'Tips for Freelancers',
            ],
            'title_ar' => [
                'description' => 'Title in Arabic (required, max 255 characters)',
                'example' => 'نصائح للمستقلين',
            ],
            'description_en' => [
                'description' => 'Description in English (required, max 5000 characters)',
                'example' => 'Here are some useful tips for freelancers to succeed in their careers...',
            ],
            'description_ar' => [
                'description' => 'Description in Arabic (required, max 5000 characters)',
                'example' => 'إليك بعض النصائح المفيدة للمستقلين للنجاح في حياتهم المهنية...',
            ],
            'image' => [
                'description' => 'An optional image for the tip or guide (jpeg, png, jpg, gif, webp; max 2MB)',
                'example' => 'No-example',
            ]
        ];
    }
}
