<?php

namespace App\Http\Requests\Auth;

use App\Rules\EmailRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Validation\Validator;

/**
 * Summary of ResetPasswordRequest
 * Handles the validation of password reset requests.
 * @param string $email
 * @param string $token
 * @param string $password
 * @param string $password_confirmation
 *
 * @property string $email
 * @property string $token
 * @property string $password
 * @property string $password_confirmation
 */
class ResetPasswordRequest extends FormRequest
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
            'email'          => [
                'required',
                'email:rfc,dns',
                'exists:users,email',
                new EmailRule
            ],
            'token'           => 'required',
            'password'        => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#\$٪\^&\*\)\(ـ\+])[A-Za-z\d!@#\$٪\^&\*\)\(ـ\+]{8,}$/u',
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
            'token' => [
                'description' => 'Password reset token received from forget password request',
                'example' => 'abc123def456ghi789jkl012mno345pqr678stu901vwx234yz567890',
            ],
            'password' => [
                'description' => 'New password (minimum 8 characters, must contain uppercase, lowercase, number, and special character)',
                'example' => 'NewPassword123!',
            ],
            'password_confirmation' => [
                'description' => 'Password confirmation (must match password)',
                'example' => 'NewPassword123!',
            ],
        ];
    }
}
