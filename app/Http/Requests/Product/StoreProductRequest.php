<?php

namespace App\Http\Requests\Product;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class StoreProductRequest extends FormRequest
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
            'accredited_balance' => 'nullable|numeric|min:0',
            'remaining_amount'   => 'nullable|numeric|min:0',
            'product_image'     => 'image|file|max:2048',
            'name' => 'required|string|max:512',
            'slug'              => 'required|unique:products',
            'category_id'       => 'required|integer',
            'unit_id'           => 'required|integer',
            'quantity'          => 'required|numeric|min:0',
            'buying_price'  => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'supplier_id' => 'required|integer|exists:suppliers,id',
            'quantity_alert' => 'required|numeric|min:0',
            'tax'               => 'nullable|numeric',
            'tax_type'          => 'nullable|integer',
            'notes'             => 'nullable|max:1000',
            'advance_debt'      => 'nullable|numeric|min:0',
            'project_completion_estimate' => 'nullable|numeric|min:0',
            'estimated_funds_2025' => 'nullable|numeric|min:0',
        ];
    }


    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->name, '-'),
            'code' => IdGenerator::generate([
                'table' => 'products',
                'field' => 'code',
                'length' => 4,
                'prefix' => 'PC'
            ]),
            'advance_debt' => $this->advance_debt ?? 0,
            'project_completion_estimate' => $this->project_completion_estimate ?? 0,
            'estimated_funds_2025' => $this->estimated_funds_2025 ?? 0,
        ]);
    }

}
