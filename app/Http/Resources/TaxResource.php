<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaxResource extends JsonResource
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
            // 'id'        => $this->id,
            'name'      => $this->name,
            'rate'      => $this->rate,
            'is_group'  => $this->is_group ? 'Yes' : 'No',
            'status'    => $this->status ? 'Active' : 'Inactive',
        ];
    }
}
