<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Validation\Validator;

/**
 * @property string $current_password
 * @property string $new_password
 */
class ChangePasswordRequest extends FormRequest
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
            'current_password' => 'required|string|min:8',
            'new_password'     => 'required|string|min:8|confirmed|different:current_password|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#\$٪\^&\*\)\(ـ\+])[A-Za-z\d!@#\$٪\^&\*\)\(ـ\+]{8,}$/u',
        ];
    }

    /**
     * Get the body parameters for Scribe documentation.
     */
    public function bodyParameters(): array
    {
        return [
            'current_password' => [
                'description' => 'User\'s current password for verification (minimum 8 characters)',
                'example' => 'CurrentPassword123!'
            ],
            'new_password' => [
                'description' => 'New password (min 8 chars, must contain uppercase, lowercase, number, and special character, must be different from current password)',
                'example' => 'NewPassword123!'
            ],
            'new_password_confirmation' => [
                'description' => 'Password confirmation (must match new_password)',
                'example' => 'NewPassword123!'
            ]
        ];
    }
}
