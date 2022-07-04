<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class CustomersController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Customer::class, 'customer');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate   = request('paginate', 10);
        $term       = request('search', '');
        $customersType       = request('customersType', null);
        $sortOrder  = request('sortOrder', 'desc');
        $orderBy    = request('orderBy', 'created_at');

        $customers = Customer::search($term)
            ->type($customersType)
            ->orderBy($orderBy, $sortOrder)
            ->paginate($paginate);

        return new CustomerCollection($customers);
    }

    // public function credit_customers()
    // {
    //     $customers = Customer::where('previous_balance', '>', 0)->latest()->paginate(10);
    //     return new CustomerCollection($customers);
    // }

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
            'email'             => 'required|email|max:255|unique:users,email',
            'phone'             => 'nullable|string|min:8|unique:customers,phone',
            'mobile'            => 'required|string|min:11|unique:customers,mobile',
            'date_of_birth'     => 'nullable|string',
            'address'           => 'nullable|string',
            'previous_balance'  => 'nullable|numeric'
        ]);

        $customer = Customer::create($attributes);

        return new CustomerResource($customer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Customer $customer, Request $request)
    {
        $attributes = request()->validate([
            'name'              => 'required|string|min:3|max:255',
            'email'             => ['required', 'email', 'max:255', Rule::unique('customers')->ignore($customer->id)],
            'phone'             => ['nullable', 'string', 'min:8', Rule::unique('customers')->ignore($customer->id)],
            'mobile'            => ['required', 'string', 'min:11', Rule::unique('customers')->ignore($customer->id)],
            'date_of_birth'     => 'nullable|string',
            'address'           => 'nullable|string',
            'previous_balance'  => 'nullable|numeric'
        ]);

        $customer->update($attributes);

        return new CustomerResource($customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response([], Response::HTTP_NO_CONTENT);
    }

    public function selectAll()
    {
        return Customer::pluck('id');
    }

    public function export($customers)
    {
        $customers = explode(',', $customers);

        // return (new customersExport($customers));
    }
}
