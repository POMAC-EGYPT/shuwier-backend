<?php

namespace App\Http\Requests\Search;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Validation\Validator;

/**
 * @property string $search
 * @property int|null $category_id
 * @property int|null $subcategory_id
 * @property string|null $hashtag
 * @property float|null $price_min
 * @property float|null $price_max
 */

class ServiceSearchRequest extends FormRequest
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
            'search'         => 'nullable|string|max:5000',
            'category_id'    => 'nullable|integer|exists:categories,id',
            'subcategory_id' => 'nullable|integer|exists:categories,id',
            'hashtag'        => 'nullable|string|max:255',
            'price_min'      => 'nullable|numeric|min:0',
            'price_max'      => 'nullable|numeric|min:0',
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
            'search' => [
                'description' => 'Search term to find services by title, description, or keywords. Optional field for text-based searching.',
                'example'     => 'wordpress website development',
            ],
            'category_id' => [
                'description' => 'Filter services by main category ID. Must be a valid category that exists in the system.',
                'example'     => 4,
            ],
            'subcategory_id' => [
                'description' => 'Filter services by subcategory ID. Must be a valid subcategory that exists in the system.',
                'example'     => 5,
            ],
            'hashtag_ids' => [
                'description' => 'Array of hashtag IDs to filter services. Services matching any of the provided hashtags will be returned.',
                'example'     => [11, 25, 30],
            ],
            'price_min' => [
                'description' => 'Minimum price filter for services. Only services with price greater than or equal to this value will be returned.',
                'example'     => 100.00,
            ],
            'price_max' => [
                'description' => 'Maximum price filter for services. Only services with price less than or equal to this value will be returned.',
                'example'     => 1000.00,
            ],
        ];
    }
}
