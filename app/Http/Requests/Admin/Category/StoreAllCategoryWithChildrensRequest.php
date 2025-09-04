<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Validation\Validator;

/**
 * Summary of StoreAllCategoryWithChildrensRequest
 * This request is used to validate the data for creating a category with its children.
 * @property string $name_en
 * @property string $name_ar
 * @property array|null $childrens
 */
class StoreAllCategoryWithChildrensRequest extends FormRequest
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
            'name_en'             => 'required|string|max:255',
            'name_ar'             => 'required|string|max:255',
            'childrens'           => 'nullable|array',
            'childrens.*.name_en' => 'required|string|max:255',
            'childrens.*.name_ar' => 'required|string|max:255',
        ];
    }
}
