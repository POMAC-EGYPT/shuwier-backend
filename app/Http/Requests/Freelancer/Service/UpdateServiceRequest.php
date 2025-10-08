<?php

namespace App\Http\Requests\Freelancer\Service;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Validation\Validator;

/**
 * UpdateServiceRequest handles the validation for updating an existing service by a freelancer.
 * It ensures that all required fields are present and correctly formatted.
 * @property string $title
 * @property string $description
 * @property int $category_id
 * @property int|null $subcategory_id
 * @property string $delivery_time_unit
 * @property int $delivery_time
 * @property string $fees_type
 * @property float $price
 * @property \Illuminate\Http\UploadedFile|null $cover_photo
 * @property array|null $hashtags
 * @property array|null $attachment_ids
 * @property array|null $faqs
 */
class UpdateServiceRequest extends FormRequest
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
            'price'              => 'required|numeric|min:1',
            'cover_photo'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'hashtags'           => 'nullable|array',
            'hashtags.*'         => 'string |max:255',
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
                'description' => 'Service title - A clear and descriptive name for your service offering (optional for updates)',
                'example' => 'Updated WordPress Website Development',
            ],
            'description' => [
                'description' => 'Detailed service description - Explain what you will deliver and how you will do it (minimum 200 characters, optional for updates)',
                'example' => 'I will create a professional WordPress website with advanced features and custom functionality tailored to your business needs. This includes responsive design, SEO optimization, contact forms, and advanced e-commerce functionality.',
            ],
            'category_id' => [
                'description' => 'Main category ID - Must be a parent category (not a subcategory, optional for updates)',
                'example' => 4,
            ],
            'subcategory_id' => [
                'description' => 'Subcategory ID - Optional, must belong to the selected main category',
                'example' => 5,
            ],
            'delivery_time_unit' => [
                'description' => 'Time unit for delivery - The unit of measurement for delivery time (optional for updates)',
                'example' => 'days',
            ],
            'delivery_time' => [
                'description' => 'Delivery time - Number of units (hours/days/months) required to complete the service (optional for updates)',
                'example' => 10,
            ],
            'fees_type' => [
                'description' => 'Pricing model - How you charge for this service (optional for updates)',
                'example' => 'fixed',
            ],
            'price' => [
                'description' => 'Service price - The cost for this service (minimum 0, optional for updates)',
                'example' => 750.00,
            ],
            'cover_photo' => [
                'description' => 'Cover photo - New main image representing your service (JPEG, PNG, JPG, WEBP, max 2MB, optional)',
                'example' => 'No-example',
            ],
            'hashtags' => [
                'description' => 'Hashtags array - Optional tags to help users find your service (replaces existing hashtags)',
                'example' => ['wordpress', 'website', 'ecommerce', 'responsive'],
            ],
            'attachment_ids' => [
                'description' => 'Attachment IDs array - Optional file attachments (must be uploaded first using upload endpoint, replaces existing attachments, max 10)',
                'example' => [18, 19, 20],
            ],
            'faqs' => [
                'description' => 'FAQs array - Optional frequently asked questions and answers about your service (replaces existing FAQs)',
                'example' => [
                    [
                        'question' => 'Do you provide SSL certificates?',
                        'answer' => 'Yes, I can help you install SSL certificates for enhanced security at no additional cost.'
                    ],
                    [
                        'question' => 'Can you integrate payment gateways?',
                        'answer' => 'Absolutely! I can integrate popular payment gateways like PayPal, Stripe, and local payment methods.'
                    ]
                ],
            ],
        ];
    }
}
