<?php

namespace App\Http\Requests\Freelancer\Service;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Validation\Validator;

/**
 * StoreServiceRequest handles the validation for storing a new service by a freelancer.
 * It ensures that all required fields are present and correctly formatted.
 * @property string $title
 * @property string $description
 * @property int $category_id
 * @property int|null $subcategory_id
 * @property string $delivery_time_unit
 * @property int $delivery_time
 * @property string $fees_type
 * @property float $price   
 * @property \Illuminate\Http\UploadedFile $cover_photo
 * @property array|null $hashtags
 * @property array|null $attachment_ids
 * @property array|null $faqs
 */
class StoreServiceRequest extends FormRequest
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
            'title'              => 'required|string|max:255',
            'description'        => 'required|string|min:200|max:2000',
            'category_id'        => 'required|exists:categories,id',
            'subcategory_id'     => 'nullable|exists:categories,id',
            'delivery_time_unit' => 'required|in:hours,days,months',
            'delivery_time'      => 'required|integer|min:1|max:365',
            'fees_type'          => 'required|in:fixed,hourly',
            'price'              => 'required|numeric|min:0',
            'cover_photo'        => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'hashtags'           => 'nullable|array',
            'hashtags.*'         => 'string|max:255',
            'attachment_ids'     => 'nullable|array|max:10',
            'attachment_ids.*'   => 'exists:service_attachments,id',
            'faqs'               => 'nullable|array',
            'faqs.*.question'    => 'required_with:faqs|string|max:255',
            'faqs.*.answer'      => 'required_with:faqs|string|max:1000',
        ];
    }

    /**
     * Define the body parameters for Scribe documentation.
     *
     * @return array
     */
    public function bodyParameters()
    {
        return [
            'title' => [
                'description' => 'Service title - A clear and descriptive name for your service offering',
                'example' => 'WordPress Website Development',
            ],
            'description' => [
                'description' => 'Detailed service description - Explain what you will deliver and how you will do it (minimum 200 characters)',
                'example' => 'I will create a professional WordPress website with custom design and functionality tailored to your business needs. This includes responsive design, SEO optimization, contact forms, and basic e-commerce functionality if needed.',
            ],
            'category_id' => [
                'description' => 'Main category ID - Must be a parent category (not a subcategory)',
                'example' => 4,
            ],
            'subcategory_id' => [
                'description' => 'Subcategory ID - Optional, must belong to the selected main category',
                'example' => 5,
            ],
            'delivery_time_unit' => [
                'description' => 'Time unit for delivery - The unit of measurement for delivery time',
                'example' => 'days',
            ],
            'delivery_time' => [
                'description' => 'Delivery time - Number of units (hours/days/months) required to complete the service',
                'example' => 7,
            ],
            'fees_type' => [
                'description' => 'Pricing model - How you charge for this service',
                'example' => 'fixed',
            ],
            'price' => [
                'description' => 'Service price - The cost for this service (minimum 0)',
                'example' => 500.00,
            ],
            'cover_photo' => [
                'description' => 'Cover photo - Main image representing your service (JPEG, PNG, JPG, WEBP, max 2MB)',
                'example' => 'No-example',
            ],
            'hashtags' => [
                'description' => 'Hashtags array - Optional tags to help users find your service',
                'example' => ['wordpress', 'website', 'development', 'responsive'],
            ],
            'attachment_ids' => [
                'description' => 'Attachment IDs array - Optional file attachments (must be uploaded first using upload endpoint)',
                'example' => [15, 16, 17],
            ],
            'faqs' => [
                'description' => 'FAQs array - Optional frequently asked questions and answers about your service',
                'example' => [
                    [
                        'question' => 'Do you provide hosting?',
                        'answer' => 'No, you need to provide your own hosting. However, I can recommend reliable hosting providers.'
                    ],
                    [
                        'question' => 'How many revisions are included?',
                        'answer' => 'I provide up to 3 revisions to ensure you are completely satisfied with the final result.'
                    ]
                ],
            ],
        ];
    }
}
