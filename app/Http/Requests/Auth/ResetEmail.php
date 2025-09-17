<?php

namespace App\Http\Requests\Auth;

use App\Rules\EmailRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Validation\Validator;

/**
 * Summary of ResetEmail
 * Handles the validation of email reset requests.
 * @param string $old_email
 * @param string $new_email
 * 
 * @property string $old_email
 * @property string $new_email
 */
class ResetEmail extends FormRequest
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
            'old_email' => [
                'required',
                'email:rfc,dns',
                new EmailRule
            ],
            'new_email' => [
                'required',
                'email:rfc,dns',
                'different:old_email',
                'unique:users,email',
                'unique:invitation_users,email',
                new EmailRule
            ],
        ];
    }

    /**
     * Get custom body parameters for API documentation.
     */
    public function bodyParameters(): array
    {
        return [
            'old_email' => [
                'description' => 'Current email address',
                'example' => 'old@example.com',
            ],
            'new_email' => [
                'description' => 'New email address (must be different from old email)',
                'example' => 'new@example.com',
            ],
        ];
    }
}
