<?php

namespace App\Http\Requests\Admin\Freelancer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Validation\Validator;


/**
 * Summary of StoreFreelancerRequest
 * @param string $first_name
 * @param string $last_name
 * @param string $email
 * @param string $phone
 * @param string $password
 * @param bool   $is_active
 * @param string $about_me
 * @param string $profile_picture
 * @param string $approval_status
 * @param string $linkedin_link
 * @param string $twitter_link
 * @param array  $other_freelance_platform_links
 * @param string $portfolio_link
 * @param string $headline
 *
 * @property string $name
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property bool   $is_active
 * @property string $about_me
 * @property string $profile_picture
 * @property string $approval_status
 * @property string $linkedin_link
 * @property string $twitter_link
 * @property array  $other_freelance_platform_links
 * @property string $portfolio_link
 * @property string $headline
 */
class StoreFreelancerRequest extends FormRequest
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
            'first_name'                       => 'required|string|max:255',
            'last_name'                        => 'nullable|string|max:255',
            'email'                            => 'required|string|email|max:255|unique:users,email',
            'phone'                            => 'nullable|string|max:255',
            'password'                         => 'nullable|string|min:8|confirmed',
            'is_active'                        => 'boolean',
            'about_me'                         => 'nullable|string',
            'profile_picture'                  => 'nullable|image|max:2048',
            'approval_status'                  => 'required|in:requested,approved',
            'linkedin_link'                    => 'nullable|url|max:255',
            'twitter_link'                     => 'nullable|url|max:255',
            'other_freelance_platform_links'   => 'nullable|array|max:3',
            'other_freelance_platform_links.*' => 'required|url|max:255',
            'portfolio_link'                   => 'nullable|url|max:255',
            'headline'                         => 'nullable|string|max:255',
        ];
    }
}
