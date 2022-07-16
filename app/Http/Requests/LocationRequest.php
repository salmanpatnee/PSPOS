<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LocationRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = !is_null($this->location) ? $this->location->id : null;

        return [
            'name'        => ['required', 'string', 'min:3', Rule::unique('locations')->ignore($id)],
            'location_id' => ['nullable', 'string', 'min:3', Rule::unique('locations', 'location_id')->ignore($id)],
            'landmark'    => ['nullable', 'string'],
            'city'        => ['nullable', 'string'],
            'mobile'      => ['required', 'string', 'min:11', Rule::unique('locations', 'mobile')->ignore($id)],
            'email'       => ['required', 'string',  Rule::unique('locations', 'email')->ignore($id)],
            'status'      => ['nullable', 'string'],
        ];
    }
}
