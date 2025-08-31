<?php

namespace App\Http\Requests\Auth;

use App\Rules\EmailRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Validation\Validator;

/**
 * Summary of LoginRequest
 * Handles the validation of login requests for users.
 * @param string $email
 * @param string $password
 *
 * @property string $email
 * @property string $password
 */
class LoginRequest extends FormRequest
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
            'email'    => [
                'required',
                'email:rfc,dns',
                'exists:users,email',
                new EmailRule,
            ],
            'password' => 'required|string|min:6',
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
            'password' => [
                'description' => 'User password (minimum 6 characters)',
                'example' => 'password123',
            ],
        ];
    }
}
