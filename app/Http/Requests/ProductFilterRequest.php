<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFilterRequest extends FormRequest
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
            'brands' => 'nullable|array',        // Ensure 'brands' is an array
            'brands.*' => 'integer|exists:brands,id', // Each brand ID must exist in the 'brands' table
        ];
    }

    public function getFilters(): array
    {
        return [
            'brands' => $this->input('brands', []),
            'priceRange' => $this->input('priceRange', null),
            'sortByPrice' => $this->input('sortByPrice', null),
            'categoryId' => $this->input('category', null),
        ];
    }
}
