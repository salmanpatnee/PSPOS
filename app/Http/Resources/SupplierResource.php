<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
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
            'id'               => $this->id,
            'name'             => $this->name,
            'email'            => $this->email,
            'phone'            => $this->phone,
            'mobile'           => $this->mobile,
            'address'          => $this->address,
            'previous_balance' => ($this->previous_balance) ? $this->previous_balance : 0,
            'advance_balance'  => ($this->advance_balance) ? $this->advance_balance : 0,
        ];
    }
}
