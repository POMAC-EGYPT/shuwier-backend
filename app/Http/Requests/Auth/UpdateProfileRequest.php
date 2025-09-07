<?php

namespace App\Http\Requests\Auth;

use App\Rules\EmailRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Validation\Validator;

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
            // 'type'                             => 'required|string|in:freelancer,client',
            // 'headline'                         => 'nullable|string|max:255',
            // 'profile_picture'                  => 'nullable|image|max:2048',
            // 'category_ids'                     => 'nullable|array',
            // 'category_ids.*'                   => 'integer|exists:categories,id',
            // 'skills'                           => 'nullable|array',
            // 'skills.*'                         => 'string|max:255',
            // 'name'                             => 'required|max:255|regex:/^(?:[ء-ي]+(?:\s[ء-ي]+)*)$|^(?:[a-zA-Z]+(?:\s[a-zA-Z]+)*)$/u',
            // 'about_me'                         => 'nullable|string|max:500',
            // 'linkedin_link'                    => 'required_if:type,freelancer|url',
            // 'twitter_link'                     => 'required_if:type,freelancer|url',
            // 'other_freelance_platform_links'   => 'required_if:type,freelancer|array|min:1|max:3',
            // 'other_freelance_platform_links.*' => 'url',
            // 'portfolio_link'                   => 'required_if:type,freelancer|url',
        ];
    }
}
