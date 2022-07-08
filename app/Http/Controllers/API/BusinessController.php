<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BusinessCollection;
use App\Http\Resources\BusinessResource;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BusinessController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Business::class, 'business');
    }

    public function index()
    {
        $businesses = Business::all();
        return new BusinessCollection($businesses);
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
        $attributes = $this->validateAttributes();

        $attributes['owner_id'] = 1;

        if ($request->logo && $request->logo != $business->logo) {

            $name = time() . '.' . explode('/', explode(':', substr($request->logo, 0, strpos($request->logo, ';')))[1])[1];
            \Image::make($request->logo)->save(public_path('images/') . $name);

            $attributes['logo'] = $name;
        }

        $business->update($attributes);

        return new BusinessResource($business);
    }



    protected function validateAttributes()
    {
        return request()->validate(
            [
                'name'                      => 'required|string|max:100',
                'currency_id'               => 'required|integer|exists:currencies,id',
                'currency_symbol_placement' => 'required|string|in:before,after',
                'tax_number'                => 'nullable|string',
                'logo'                      => 'nullable|string',
                'email_settings.driver'     => 'nullable|string',
                'email_settings.host'       => 'nullable|string',
                'email_settings.port'       => 'nullable|numeric',
                'email_settings.username'   => 'nullable|email',
                'email_settings.password'   => 'nullable|string',
                'email_settings.encryption' => 'nullable|string|in:SSL,TLS,STARTTLS',
                'email_settings.'           => 'nullable|email',
                'email_settings.name'       => 'nullable|string',
            ],
            [
                'name.required'                 => 'Business Name is required.',
                'currency_id.required'          => 'Currency is required.',
                'email_settings.username.email' => 'Username must be a valid email address.',
                'email_settings.from'           => 'From Email must be a valid email address.',
            ]
        );
    }
}
