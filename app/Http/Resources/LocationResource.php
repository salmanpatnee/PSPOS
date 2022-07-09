<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
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
            'business' => $this->business->name,
            'name' => $this->name,
            'location_id' => $this->when(!is_null($this->location_id), $this->location_id),
            'landmark' => $this->when(!is_null($this->landmark), $this->landmark),
            'city' => $this->when(!is_null($this->city), $this->city),
            'mobile' => $this->mobile,
            'email' => $this->email,
            'status' => ($this->status) ? 'Active' : 'Inactive',

        ];
    }
}
