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
 * @property array $attachment_ids
 * @property int $cover_id
 * @property array|null $hashtags
 */
class PortfolioRequest extends FormRequest
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
            'title'             => 'required|string|max:255',
            'description'       => 'required|string',
            'category_id'       => 'required|integer|exists:categories,id',
            'subcategory_id'    => 'nullable|integer|exists:categories,id',
            'attachment_ids'    => 'nullable|array|max:8',
            'attachment_ids.*'  => 'nullable|integer|exists:portfolio_attachments,id',
            'cover_id'          => 'required|integer|exists:portfolio_attachments,id',
            'hashtags'          => 'nullable|array',
            'hashtags.*'        => 'string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'cover_id.required' => 'The thumbnail image is required.',
        ];
    }

    /**
     * Get the body parameters for Scribe documentation.
     */
    public function bodyParameters(): array
    {
        return [
            'title' => [
                'description' => 'The portfolio title (max 255 characters)',
                'example' => 'E-commerce Website'
            ],
            'description' => [
                'description' => 'The portfolio description',
                'example' => 'A modern responsive e-commerce website built with React and Laravel'
            ],
            'category_id' => [
                'description' => 'The main category ID (must be a parent category)',
                'example' => 1
            ],
            'subcategory_id' => [
                'description' => 'The subcategory ID (must belong to the selected category)',
                'example' => 2
            ],
            'attachment_ids' => [
                'description' => 'Array of attachment IDs from uploaded files (max 8 files). Use /api/upload endpoint first to upload files and get IDs.',
                'example' => [15, 16, 17]
            ],
            'cover_id' => [
                'description' => 'The attachment ID to set as the cover image. Must be one of the uploaded attachments.',
                'example' => 20
            ],
            'hashtags' => [
                'description' => 'Array of hashtag strings (max 255 characters each)',
                'example' => ['react', 'ecommerce', 'laravel']
            ]
        ];
    }
}
