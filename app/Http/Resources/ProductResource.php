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
            'id' => $this->id,
            'product_id' => $this->product_id,
            'category' => $this->category->name,
            'brand' => $this->brand->name,
            'name' => $this->name,
            'image' => $this->when(!is_null($this->image), $this->image),
            'description' => $this->when(!is_null($this->description), $this->description),
            'price' => $this->when(!is_null($this->price), $this->price),
            'vat' => $this->when(!is_null($this->vat), $this->vat),
            'units_sold' => $this->units_sold,
            'stock_threshold' => $this->stock_threshold,
            'status' => $this->status ? 'Active' : 'Inactive',
            'added_by' => $this->creator->name,
        ];
    }
}
