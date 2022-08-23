<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductPurchaseDetail extends JsonResource
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
            'name' => $this->name,
            'vat' => $this->vat,
            'purchase_price' => $this->default_purchase_price,
            'selling_price' => $this->default_selling_price,
            'quantity_available' => count($this->locations)
                ? $this->locations[0]->pivot->quantity_available // Why with 0 index
                : 0
        ];
    }
}
