<?php

namespace App\Http\Requests\Freelancer\Service;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'title' => 'required|string|max:255',
            // 'description' => 'required|string|min:200|max:2000',
            // 'category_id' => 'required|exists:categories,id',
            // 'subcategory_id' => 'nullable|exists:categories,id',
            // 'hashtags' => 'nullable|array',
            // 'hashtags.*' => 'string|max:255',
            // 'delivery_time_unit' => 'required|in:hours,days,months',
            // 'delivery_time' => 'required|integer|min:1',
            // 'service_fees_type' => 'required|in:fixed,hourly',
            // 'price' => 'required|numeric|min:0',
            // 'cover_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'attachments' => 'nullable|array',
            // 'attachments.*' => 'file|mimes:jpeg,png,jpg,gif,pdf|max:5120',
            // 'faqs' => 'nullable|array',
            // 'faqs.*.question' => 'required_with:faqs|string|max:255',
            // 'faqs.*.answer' => 'required_with:faqs|string|max:1000',
        ];
    }
}
