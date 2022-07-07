<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BusinessResource;
use App\Models\Business;
use Illuminate\Http\Request;

class BusinessController extends Controller
{

    public function index()
    {
        $business = Business::latest()->first();

        return new BusinessResource($business);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Business $business)
    {
        return new BusinessResource($business);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Business $business, Request $request)
    {
        $attributes = $request->validate([
            'name'                      => 'required|string|max:100',
            'currency_id'               => 'required|integer|exists:currencies,id',
            'owner_id'                  => 'required|integer|exists:users,id',
            'currency_symbol_placement' => 'required|string|in:before,after',
            'tax_number'                => 'nullable|string',
            'logo'                      => 'nullable|string',
            'email_settings'            => 'nullable|string',
            'sms_settings'              => 'nullable|string',
        ]);

        // $attributes['email_settings'] = json_encode($request->email_settings);
        // $attributes['sms_settings']   = json_encode($request->sms_settings);

        $business->update($attributes);

        return new BusinessResource($business);
    }
}
