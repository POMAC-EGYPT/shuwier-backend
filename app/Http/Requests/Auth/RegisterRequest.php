<?php

namespace App\Http\Requests\Auth;

use App\Rules\EmailRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Validation\Validator;

/**
 * Summary of RegisterRequest
 * This request validates the registration data for new users.
 * @param string $name
 * @param string $email
 * @param string $password
 * @param string $type (freelancer|client)
 * @param string|null $linkedin_link (required if type is freelancer)
 * @param string|null $twitter_link (required if type is freelancer)
 * @param array|null $other_freelance_platform_links (required if type is freelancer and min:1|max:3)
 * @param string|null $portfolio_link (required if type is freelancer)
 * 
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $type (freelancer|client)
 * @property string|null $linkedin_link (required if type is freelancer)
 * @property string|null $twitter_link (required if type is freelancer)
 * @property array|null $other_freelance_platform_links (required if type is freelancer and min:1|max:3)
 * @property string|null $portfolio_link (required if type is freelancer)
 */
class RegisterRequest extends FormRequest
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
            'name'                             => [
                'required',
                'max:255',
                'regex:/^(?:[ء-ي]+(?:\s[ء-ي]+)*)$|^(?:[a-zA-Z]+(?:\s[a-zA-Z]+)*)$/u'
            ],
            'email'                            => [
                'required',
                'string',
                'email:rfc,dns',
                'max:255',
                'unique:users',
                new EmailRule,
            ],
            'password'                         => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#\$٪\^&\*\)\(ـ\+])[A-Za-z\d!@#\$٪\^&\*\)\(ـ\+]{8,}$/u',
            'type'                             => 'required|string|in:freelancer,client',
            'linkedin_link'                    => 'required_if:type,freelancer|url',
            'twitter_link'                     => 'required_if:type,freelancer|url',
            'other_freelance_platform_links'   => 'required_if:type,freelancer|array|min:1|max:3',
            'other_freelance_platform_links.*' => 'url',
            'portfolio_link'                   => 'required_if:type,freelancer|url',
        ];
    }

    /**
     * Get custom body parameters for API documentation.
     */
    public function bodyParameters(): array
    {
        return [
            'name' => [
                'description' => 'User full name',
                'example' => 'John Doe',
            ],
            'email' => [
                'description' => 'User email address (must be unique)',
                'example' => 'user@example.com',
            ],
            'password' => [
                'description' => 'User password (minimum 8 characters, must contain uppercase, lowercase, number, and special character)',
                'example' => 'Password123!',
            ],
            'password_confirmation' => [
                'description' => 'Password confirmation (must match password)',
                'example' => 'Password123!',
            ],
            'type' => [
                'description' => 'User type (freelancer or client)',
                'example' => 'freelancer',
            ],
            'linkedin_link' => [
                'description' => 'LinkedIn profile URL (required if type is freelancer)',
                'example' => 'https://linkedin.com/in/johndoe',
            ],
            'twitter_link' => [
                'description' => 'Twitter profile URL (required if type is freelancer)',
                'example' => 'https://twitter.com/johndoe',
            ],
            'other_freelance_platform_links' => [
                'description' => 'Array of other freelance platform URLs (required if type is freelancer, min: 1, max: 3)',
                'example' => ['https://upwork.com/freelancers/johndoe', 'https://fiverr.com/johndoe'],
            ],
            'portfolio_link' => [
                'description' => 'Portfolio website URL (required if type is freelancer)',
                'example' => 'https://johndoe.com',
            ],
        ];
    }
}
