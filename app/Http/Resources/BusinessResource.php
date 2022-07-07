<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BusinessResource extends JsonResource
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
            'currency_id' => $this->currency_id,
            'currency_symbol_placement' => $this->currency_symbol_placement,
            'owner' => $this->owner->name,
            'tax_number' => $this->when(!is_null($this->tax_number), $this->tax_number),
            'logo' => $this->when(!is_null($this->logo), $this->logo),
            'email_settings' => $this->email_settings
        ];
    }
}
