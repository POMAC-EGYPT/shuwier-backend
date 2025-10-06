<?php

namespace App\Http\Requests\Cilent\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Validation\Validator;

/**
 * @property string $title
 * @property string $description
 * @property int $category_id
 * @property int|null $subcategory_id
 * @property string $budget
 * @property string $deadline_unit
 * @property int $deadline
 * @property array|null $attachment_ids
 */
class StoreProjectRequest extends FormRequest
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
            'title'            => 'required|string|max:255',
            'description'      => 'required|string|min:100|max:2000',
            'category_id'      => 'required|integer|exists:categories,id',
            'subcategory_id'   => 'nullable|integer|exists:categories,id',
            'budget'           => 'required|string',
            'deadline_unit'    => 'required|in:hours,days,months',
            'deadline'         => 'required|integer|min:1',
            'attachment_ids'   => 'nullable|array',
            'attachment_ids.*' => 'required|integer|exists:project_attachments,id',
        ];
    }

    /**
     * Define the body parameters for Scribe documentation.
     *
     * @return array
     */
    public function bodyParameters()
    {
        return [
            'title' => [
                'description' => 'Project title - A clear and descriptive name for your project that summarizes what you need',
                'example' => 'E-commerce Website Development',
            ],
            'description' => [
                'description' => 'Detailed project description - Explain your project requirements, goals, expectations, and any specific features needed (minimum 100 characters)',
                'example' => 'I need a complete e-commerce website with product catalog, shopping cart, payment integration, and admin dashboard. The site should be responsive and SEO-optimized with modern design and user-friendly interface.',
            ],
            'category_id' => [
                'description' => 'Main category ID - Must be a valid parent category that best matches your project type',
                'example' => 4,
            ],
            'subcategory_id' => [
                'description' => 'Subcategory ID - Optional, must belong to the selected main category for more specific project categorization',
                'example' => 5,
            ],
            'budget' => [
                'description' => 'Project budget - Specify your budget range, fixed amount, or budget type for this project',
                'example' => '$1000-$2000',
            ],
            'deadline_unit' => [
                'description' => 'Time unit for project deadline - The unit of measurement for your project completion timeline',
                'example' => 'days',
            ],
            'deadline' => [
                'description' => 'Project deadline - Number of units (hours/days/months) within which you need the project completed',
                'example' => 12,
            ],
            'attachment_ids' => [
                'description' => 'Array of attachment IDs - Optional files that provide additional project details, mockups, or requirements (must be uploaded first using upload endpoint)',
                'example' => [2, 3, 4],
            ],
        ];
    }
}
