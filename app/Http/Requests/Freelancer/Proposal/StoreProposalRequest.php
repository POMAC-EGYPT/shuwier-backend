<?php

namespace App\Http\Requests\Freelancer\Proposal;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Validation\Validator;

/**
 * @property string $cover_letter
 * @property string $estimated_time_unit
 * @property int $estimated_time
 * @property string $fees_type
 * @property float $bid_amount
 * @property int $project_id
 * @property array|null $attachment_ids
 */
class StoreProposalRequest extends FormRequest
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
            'cover_letter'        => 'required|string',
            'estimated_time_unit' => 'required|in:hours,days,months',
            'estimated_time'      => 'required|integer|min:1|max:365',
            'fees_type'           => 'required|in:fixed,hourly',
            'bid_amount'          => 'required|numeric|min:1|max:1000000',
            'project_id'          => 'required|integer|exists:projects,id',
            'attachment_ids'      => 'nullable|array|max:10',
            'attachment_ids.*'    => 'nullable|integer|exists:proposal_attachments,id',
        ];
    }

    public function BodyParameters(): array
    {
        return [
            'cover_letter'        => [
                'description' => 'The cover letter for the proposal.',
                'example'     => 'I am very interested in your project and believe I can deliver great results.',
            ],
            'estimated_time_unit' => [
                'description' => 'The unit of time for the estimated time to complete the project.',
                'example'     => 'days',
            ],
            'estimated_time'      => [
                'description' => 'The estimated time to complete the project in the specified unit.',
                'example'     => 10,
            ],
            'fees_type'           => [
                'description' => 'The type of fees for the proposal, either fixed or hourly.',
                'example'     => 'fixed',
            ],
            'bid_amount'          => [
                'description' => 'The bid amount for the proposal.',
                'example'     => 500.00,
            ],
            'project_id'          => [
                'description' => 'The ID of the project for which the proposal is being made.',
                'example'     => 1,
            ],
            'attachment_ids'      => [
                'description' => 'An array of attachment IDs associated with the proposal.',
                'example'     => [1, 2, 3],
            ],
        ];
    }
}
