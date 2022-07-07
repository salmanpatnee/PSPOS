<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class SuppliersController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Supplier::class, 'supplier');
    }


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

        $suppliers = Supplier::search($term)
            ->orderBy($orderBy, $sortOrder)
            ->paginate($paginate);

        return SupplierResource::collection($suppliers);
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
            'name'              => 'required|string|min:3|max:255',
            'email'             => 'required|email|max:255|unique:suppliers,email',
            'phone'             => 'nullable|string|min:8|unique:suppliers,phone',
            'mobile'            => 'required|string|min:11|unique:suppliers,mobile',
            'address'           => 'nullable|string',
            'previous_balance'  => 'nullable|numeric',
            'advance_balance'   => 'nullable|numeric'
        ]);

        $supplier = Supplier::create($attributes);

        return new SupplierResource($supplier);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        return new SupplierResource($supplier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Supplier $supplier, Request $request)
    {
        $attributes = request()->validate([
            'name'              => 'required|string|min:3|max:255',
            'email'             => ['required', 'email', 'max:255', Rule::unique('suppliers')->ignore($supplier->id)],
            'phone'             => ['nullable', 'string', 'min:8', Rule::unique('suppliers')->ignore($supplier->id)],
            'mobile'            => ['required', 'string', 'min:11', Rule::unique('suppliers')->ignore($supplier->id)],
            'address'           => 'nullable|string',
            'previous_balance'  => 'nullable|numeric',
            'advance_balance'  => 'nullable|numeric'
        ]);

        $supplier->update($attributes);

        return new SupplierResource($supplier);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return response([], Response::HTTP_NO_CONTENT);
    }
}
