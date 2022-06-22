<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'id'              => $this->id,
            'name'            => $this->name,
            'email'           => $this->email,
            'phone'           => $this->phone,
            'mobile'          => $this->mobile,
            'dob'             => $this->when(!is_null($this->date_of_birth), Carbon::parse($this->date_of_birth)->format('d M Y')),
            'address'         => $this->address,
            'balance'         => ($this->previous_balance) ? $this->previous_balance : 0,
            'total_purchases' => $this->total_purchases,
            'last_purchase'   => $this->when(!is_null($this->last_purchase), Carbon::parse($this->last_purchase)->format('d M Y')),
        ];
    }
}
