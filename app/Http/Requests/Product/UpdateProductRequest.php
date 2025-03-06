<?php

namespace App\Http\Requests\Product;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [

            'name'                       => 'required|string|max:255',
            'slug'                       => ['required', Rule::unique('products')->ignore($this->product)],
            'code'                       => 'nullable|string|max:255',
            'category_id'                => 'required|integer|exists:categories,id',
            'unit_id'                    => 'required|integer|exists:units,id',
            'quantity'                   => 'required|integer|min:0',
            'quantity_alert'             => 'required|integer|min:0',
            'buying_price'               => 'required|numeric|min:0',
            'selling_price'              => 'required|numeric|min:0',
            'tax'                        => 'nullable|numeric|min:0',
            'notes'                      => 'nullable|string|max:1000',
            'project_estimate_documents' => 'nullable|boolean',
            'construction_permit'        => 'nullable|boolean',
            'remaining_amount'           => 'nullable|numeric|min:0',
            'accredited_balance'         => 'nullable|numeric|min:0',
            'advance_debt'               => 'nullable|numeric|min:0',
            'project_completion_estimate'=> 'nullable|numeric|min:0',
            'estimated_funds_2025'       => 'nullable|numeric|min:0'
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->name, '-'),
        ]);
    }
}
