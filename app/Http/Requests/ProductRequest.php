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
            'name'            => ['required', 'string', 'min:3', Rule::unique('products')->ignore($id)],
            'category_id'     => ['required', 'integer', Rule::exists('categories', 'id')],
            'brand_id'        => ['nullable', 'integer', Rule::exists('brands', 'id')],
            'product_id'      => ['required', 'string', 'min:3', Rule::unique('products')->ignore($id)],
            'image'           => ['nullable', 'string'],
            'description'     => ['nullable', 'string'],
            'price'           => ['required', 'numeric'],
            'vat'             => ['nullable', 'numeric'],
            'stock_threshold' => ['nullable', 'integer'],
            'status'          => ['nullable', 'string'],
        ];
    }
}
