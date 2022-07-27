<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseRequest;
use App\Models\Business;
use App\Models\Product;
use App\Models\Reference;
use App\Models\Tax;
use App\Models\Transaction;
use App\Utils\Utils;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    protected $util;

    public function __construct(Utils $util)
    {
        $this->util = $util;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseRequest $request)
    {
        try {

            $attributes = $request->validated();
            $settings   = Cache::get('businesses');
            $userId     = auth()->id();

            $attributes['business_id'] = $settings[0]->id;
            $attributes['created_by'] = $userId;
            $attributes['type'] = 'purchase';
            $attributes['payment_status'] = 'due';

            DB::beginTransaction();

            $reference_count = $this->util->updateReferenceCount($attributes['type'], $attributes['business_id']);

            if (empty($attributes['reference_no'])) {

                $attributes['reference_no'] = $this->util->generateReferenceNo($reference_count);
            }

            $transaction = Transaction::create($attributes);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getProductDetails()
    {
        $productId  = request('product_id');
        $locationId = request('location_id');

        if (!empty($productId)) {

            $product = Product::select('id', 'name', 'vat', 'default_purchase_price', 'default_selling_price')->where('id', $productId)->with(['locations' => function ($query) use ($locationId) {
                $query->where('location_product.location_id', $locationId);
            }])->get();

            // return $product[0]->locations[0]->pivot->quantity_available;
            return $product[0];
        }

        return [];
    }
}
