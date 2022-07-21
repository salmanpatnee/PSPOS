<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $id = !is_null($this->product) ? $this->product->id : null;

        return [
            'sku'                       => ['nullable', 'string'],
            'name'                      => ['required', 'string', 'min:3', Rule::unique('products')->ignore($id)],
            'category_id'               => ['required', 'integer', Rule::exists('categories', 'id')],
            'brand_id'                  => ['nullable', 'integer', Rule::exists('brands', 'id')],
            'product_id'                => ['required', 'string', 'min:3', Rule::unique('products')->ignore($id)],
            'image'                     => ['nullable', 'string'],
            'description'               => ['nullable', 'string'],
            'vat'                       => ['nullable', 'numeric'],
            'stock_threshold'           => ['nullable', 'integer'],
            'status'                    => ['nullable', 'string'],
            'default_purchase_price'    => ['nullable', 'numeric'],
            'default_selling_price'     => 'required_with:default_purchase_price|numeric|gt:default_purchase_price'
        ];
    }

    public function messages()
    {
        return [
            'default_purchase_price.numeric' => 'Purchase price must be a number.',
            'default_selling_price.numeric' => 'Selling price must be a number.'
        ];
    }
}
