<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'product_id'        => $this->product_id,
            'category'          => $this->category->name,
            'category_id'       => $this->category_id,
            'brand'             => $this->brandName,
            'brand_id'          => $this->brand_id,
            'name'              => $this->name,
            'image_src'         => $this->imagePath,
            'description'       => $this->when(!is_null($this->description), $this->description),
            'price'             => $this->when(!is_null($this->price), $this->price),
            'vat'               => $this->when(!is_null($this->vat), $this->vat),
            'units_sold'        => $this->units_sold,
            'stock_threshold'   => $this->stock_threshold,
            'default_purchase_price'   => $this->default_purchase_price,
            'default_selling_price'   => $this->default_selling_price,
            'status'            => $this->status ? 'Active' : 'Inactive',
            'added_by'          => $this->creator->name,
        ];
    }
}
