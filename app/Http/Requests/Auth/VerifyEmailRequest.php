<?php

namespace App\Http\Requests\Auth;

use App\Rules\EmailRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Validation\Validator;

/**
 * Summary of VerifyEmailRequest
 * Handles the validation of email verification requests.
 * @param string $email
 * @param string $otp
 * 
 * @property string $email
 * @property string $otp
 */
class VerifyEmailRequest extends FormRequest
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
            'email' => [
                'required',
                'email:rfc,dns',
                new EmailRule
            ],
            'otp'   => 'required|digits:4',
        ];
    }

    /**
     * Get custom body parameters for API documentation.
     */
    public function bodyParameters(): array
    {
        return [
            'email' => [
                'description' => 'User email address',
                'example' => 'user@example.com',
            ],
            'otp' => [
                'description' => '4-digit verification code sent to email',
                'example' => '1234',
            ],
        ];
    }
}
