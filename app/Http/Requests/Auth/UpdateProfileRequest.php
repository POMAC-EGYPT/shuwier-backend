<?php

namespace App\Http\Requests\Auth;

use App\Rules\EmailRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Validation\Validator;

/**
 * @property string $type
 * @property string $name
 * @property \Illuminate\Http\UploadedFile $profile_picture
 * @property string $about_me
 * @property string|null $headline
 * @property int $category_id
 * @property array $skill_ids
 * @property string|null $company
 * @property string|null $phone
 */
class UpdateProfileRequest extends FormRequest
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
        $type = auth('api')->user()->type;

        $rules = [
            'name'                         => [
                'sometimes',
                'required',
                'max:255',
                'regex:/^([ء-ي\s]+|[a-zA-Z\s]+)$/u'
            ],
            'profile_picture'               => 'sometimes|nullable|image|max:2048',
            'about_me'                      => 'sometimes|nullable|string|max:500',
            'country'                       => 'sometimes|nullable|string|max:100',
            'city'                          => 'sometimes|nullable|string|max:100',
            'languages'                  => 'sometimes|array',
            'languages.*.language_id'    => 'required|exists:languages,id',
            'languages.*.language_level' => 'required|in:beginner,intermediate,advanced,native',
        ];

        if ($type === 'freelancer') {
            $rules = array_merge($rules, [
                'headline'    => 'sometimes|nullable|string|max:255',
                'category_id' => 'sometimes|nullable|exists:categories,id',
                'skill_ids'   => 'sometimes|nullable|array',
                'skill_ids.*' => 'exists:skills,id',
                'company'     => 'prohibited',
                'phone'       => 'prohibited',
            ]);
        }

        if ($type === 'client') {
            $rules = array_merge($rules, [
                'company'     => 'sometimes|nullable|string|max:255',
                'phone'       => 'sometimes|nullable|regex:/^(\+966|00966|966)?[5][0-9]{8}$/',
                'headline'    => 'prohibited',
                'category_id' => 'prohibited',
                'skill_ids'   => 'prohibited',
            ]);
        }

        return $rules;
    }

    /**
     * Get the body parameters for Scribe documentation.
     */
    public function bodyParameters(): array
    {
        return [
            'name' => [
                'description' => 'User full name (Arabic or English characters only, max 255 characters, optional)',
                'example' => 'أحمد محمد'
            ],
            'profile_picture' => [
                'description' => 'Profile picture image file (optional, max 2MB)',
                'example' => 'No-example'
            ],
            'about_me' => [
                'description' => 'About me description (optional, max 500 characters)',
                'example' => 'مطور ويب محترف مع خبرة 5 سنوات'
            ],
            'headline' => [
                'description' => 'Professional headline (for freelancers only, optional, max 255 characters)',
                'example' => 'Full Stack Developer'
            ],
            'category_id' => [
                'description' => 'Main category ID (for freelancers only, optional, must exist in categories table)',
                'example' => 1
            ],
            'skill_ids' => [
                'description' => 'Array of skill IDs (for freelancers only, optional, each ID must exist in skills table)',
                'example' => [1, 2, 3]
            ],
            'company' => [
                'description' => 'Company name (for clients only, optional, max 255 characters)',
                'example' => 'Tech Solutions Inc.'
            ],
            'phone' => [
                'description' => 'Phone number in Saudi format (for clients only, optional)',
                'example' => '+966501234567'
            ]
        ];
    }
}
