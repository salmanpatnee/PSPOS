<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
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

        $products = Product::search($term)
            ->orderBy($orderBy, $sortOrder)
            ->paginate($paginate);

        return ProductResource::collection($products);
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
            'name'            => 'required|string|min:3|unique:products,name',
            'category_id'     => 'required|integer|exists:categories,id',
            'brand_id'        => 'required|integer|exists:brands,id',
            'product_id'      => 'required|string|min:3|unique:products,product_id',
            'image'           => 'nullable|string',
            'description'     => 'nullable|string',
            'price'           => 'nullable|numeric',
            'vat'             => 'nullable|numeric',
            'stock_threshold' => 'nullable|integer',
            'status'          => 'nullable|string',
        ]);

        $attributes['created_by'] = auth()->id();

        $product = Product::create($attributes);

        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
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
    public function destroy(Product $product)
    {
        $product->delete();

        return response([], Response::HTTP_NO_CONTENT);
    }
}
