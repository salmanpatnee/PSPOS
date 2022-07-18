<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaxResource;
use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class TaxController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Tax::class, 'tax');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxes = Tax::paginate(20);
        return TaxResource::collection($taxes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $this->validateAttributes($request);

        $attributes['created_by'] = auth()->id();

        $tax = Tax::create($attributes);

        return new TaxResource($tax);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tax $tax)
    {
        return new TaxResource($tax);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tax $tax)
    {
        $attributes = $this->validateAttributes($request, $tax);

        $tax->update($attributes);

        return new TaxResource($tax);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tax $tax)
    {
        $tax->delete();

        return response([], Response::HTTP_NO_CONTENT);
    }

    protected function validateAttributes(Request $request, Tax $tax = null)
    {
        $id = !is_null($tax) ? $tax->id : null;

        return $request->validate([
            'name'   => ['required', 'string', 'min:3', 'max:100', Rule::unique('taxes')->ignore($id)],
            'rate'   => 'required|numeric',
        ]);
    }
}
