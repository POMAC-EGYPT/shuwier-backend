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
 * @property string|null $linkedin_link
 * @property string|null $twitter_link
 * @property array|null $other_freelance_platform_links
 * @property string|null $portfolio_link
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
        return [
            'type'                             => 'required|string|in:freelancer,client',
            'name'                             => [
                'required',
                'max:255',
                'regex:/^([ء-ي\s]+|[a-zA-Z\s]+)$/u'
            ],
            'profile_picture'                  => 'nullable|image|max:2048',
            'about_me'                         => 'required|string|max:500',
            'headline'                         => 'required_if:type,freelancer|string|max:255',
            'category_id'                      => 'required_if:type,freelancer|exists:categories,id',
            'skill_ids'                        => 'required_if:type,freelancer|array',
            'skill_ids.*'                      => 'required|exists:skills,id',
            'company'                          => 'prohibitedIf:type,freelancer|nullable|string|max:255',
            'phone'                            => [
                'required_if:type,client',
                'regex:/^(\+966|00966|966)?[5][0-9]{8}$/'
            ],
            'linkedin_link'                    => 'required_if:type,freelancer|url',
            'twitter_link'                     => 'required_if:type,freelancer|url',
            'other_freelance_platform_links'   => 'required_if:type,freelancer|array|min:1|max:3',
            'other_freelance_platform_links.*' => 'url',
            'portfolio_link'                   => 'required_if:type,freelancer|url',
        ];
    }

    /**
     * Get the body parameters for Scribe documentation.
     */
    public function bodyParameters(): array
    {
        return [
            'type' => [
                'description' => 'User type (cannot change from freelancer to client)',
                'example' => 'freelancer'
            ],
            'name' => [
                'description' => 'User full name (Arabic or English)',
                'example' => 'أحمد محمد'
            ],
            'profile_picture' => [
                'description' => 'Profile picture image file (optional, max 2MB)',
                'example' => 'No-example'
            ],
            'about_me' => [
                'description' => 'About me description (max 500 characters)',
                'example' => 'مطور ويب محترف مع خبرة 5 سنوات'
            ],
            'headline' => [
                'description' => 'Professional headline (required for freelancers)',
                'example' => 'Full Stack Developer'
            ],
            'category_id' => [
                'description' => 'Main category ID (required for freelancers, must be parent category)',
                'example' => 1
            ],
            'skill_ids' => [
                'description' => 'Array of skill IDs (required for freelancers)',
                'example' => [1, 2, 3]
            ],
            'company' => [
                'description' => 'Company name (for clients only)',
                'example' => 'Tech Solutions Inc.'
            ],
            'phone' => [
                'description' => 'Phone number (required for clients, Saudi format)',
                'example' => '+966501234567'
            ],
            'linkedin_link' => [
                'description' => 'LinkedIn profile URL (required for freelancers)',
                'example' => 'https://linkedin.com/in/ahmed-mohamed'
            ],
            'twitter_link' => [
                'description' => 'Twitter profile URL (required for freelancers)',
                'example' => 'https://twitter.com/ahmed_mohamed'
            ],
            'other_freelance_platform_links' => [
                'description' => 'Array of other freelance platform URLs (required for freelancers, 1-3 links)',
                'example' => ['https://upwork.com/freelancers/ahmed', 'https://freelancer.com/u/ahmed']
            ],
            'portfolio_link' => [
                'description' => 'Portfolio website URL (required for freelancers)',
                'example' => 'https://ahmed-portfolio.com'
            ]
        ];
    }
}
