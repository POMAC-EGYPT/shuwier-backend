<?php

namespace App\Http\Requests\Freelancer\Proposal;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Validation\Validator;

/**
 * @property string|null $status
 * @property string|null $search
 * @property int|null $per_page
 */
class ProposalSearchRequest extends FormRequest
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
            'status'   => 'nullable|array',
            'status.*' => 'required|string|in:submitted,viewed,accepted,rejected',
            'search'   => 'nullable|string|max:255',
            'per_page' => 'nullable|integer|min:1|max:50',
        ];
    }

    public function queryParameters(): array
    {
        return [
            'status' => [
                'description' => 'Filter proposals by their status. Accepts an array of statuses: submitted, viewed, accepted, rejected.',
                'example'     => ['submitted', 'viewed'],
            ],
            'search' => [
                'description' => 'A search term to filter proposals based on the project title.',
                'example'     => 'Website Development',
            ],
            'per_page' => [
                'description' => 'Number of items to display per page in the paginated response. Default is 15, maximum is 50.',
                'example'     => 15,
            ],
        ];
    }
}
