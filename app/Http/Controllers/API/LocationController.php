<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginate      = request('paginate', 10);
        $term          = request('search', '');
        $sortOrder     = request('sortOrder', 'desc');
        $orderBy       = request('orderBy', 'created_at');

        $locations = Location::search($term)
            ->orderBy($orderBy, $sortOrder)
            ->paginate($paginate);

        return LocationResource::collection($locations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name'        => 'required|string|min:3|unique:locations,name',
            'location_id' => 'required|string|min:3|unique:locations,location_id',
            'landmark'    => 'nullable|string',
            'city'        => 'nullable|string',
            'mobile'      => 'required|string|min:11|unique:locations,mobile',
            'email'       => 'required|email|unique:locations,email',
            'status'   => 'nullable|string',
        ]);

        $attributes['business_id'] = 1;

        $location = Location::create($attributes);

        return new LocationResource($location);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        return new LocationResource($location);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Location $location, Request $request)
    {
        $attributes = request()->validate([
            'name'        => ['required', 'string', 'min:3', Rule::unique('locations')->ignore($location->id)],
            'location_id' => ['required', 'string', 'min:3', Rule::unique('locations')->ignore($location->id)],
            'landmark'    => 'nullable|string',
            'city'        => 'nullable|string',
            'mobile'      => ['required', 'string', 'min:11', Rule::unique('locations')->ignore($location->id)],
            'email'       => ['required', 'email', Rule::unique('locations')->ignore($location->id)],
            'status'   => 'nullable|string',
        ]);

        $location = Location::find($location->id);
        $location->update($attributes);

        return new LocationResource($location);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $location->delete();

        return response([], Response::HTTP_NO_CONTENT);
    }
}
