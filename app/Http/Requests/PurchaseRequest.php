<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PurchaseRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'location_id'        => ['required', 'integer', Rule::exists('locations', 'id')],
            'supplier_id'        => ['required', 'integer', Rule::exists('suppliers', 'id')],
            'purchase_order_ids' => ['nullable', 'string'],
            'reference_no'       => ['nullable', 'string'],
            'status'             => ['required', Rule::in(['received', 'pending', 'ordered'])],
            'tax_id'             => ['nullable', Rule::exists('taxes', 'id')],
            'tax_amount'         => ['nullable', 'numeric'],
            'discount_type'      => ['nullable', Rule::in(['fixed', 'percentage'])],
            'discount_amount'    => ['nullable', 'numeric'],
            'shipping_details'   => ['nullable', 'string'],
            'shipping_charges'   => ['nullable', 'numeric'],
            'total_before_tax'   => ['required', 'numeric'],
            'final_total'        => ['required', 'numeric'],
            'additional_notes'   => ['nullable', 'string'],
            // 'document'           => ['nullable', 'string'],
            'transaction_date'   => ['required', 'date'],
        ];
    }

    public function messages()
    {
        return [
            'location_id.required' => 'Location/Branch is required.',
            'supplier_id.required' => 'Supplier is required.',
        ];
    }
}
