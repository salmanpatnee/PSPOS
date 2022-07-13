<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name'              => $this->name,
            'email'             => $this->email,
            'status'            => $this->status ? 'Active' : 'Inactive',
            'role'              => $this->getRoleNames()->first(),
            'business_location' => $this->when(!is_null($this->location), $this->location),
            'location_name'     => ($this->location) ? $this->location->name : '',
            'permissions'       => $this->getPermissionsViaRoles()->pluck('name'),
            'joining_date'      => $this->created_at->format('d M Y'),
            'last_login'        => $this->when(!is_null($this->last_login_at), Carbon::parse($this->last_login_at)->diffForHumans()),

        ];
    }
}
