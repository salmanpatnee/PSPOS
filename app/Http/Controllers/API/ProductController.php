<?php

namespace App\Http\Controllers\API;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Variation;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\UploadImageTrait;
use App\Utils\Utils;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    use UploadImageTrait;

    protected $productUtil;

    public function __construct(Utils $productUtil)
    {
        $this->productUtil = $productUtil;
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

        $products = Product::search($term)
            ->active()
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
    public function store(ProductRequest $request)
    {
        $attributes = $request->all();

        $attributes['created_by']   = auth()->id();
        $attributes['image']        = $this->uploadTheImage($request, "image", "images/products/");

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
    public function update(Product $product, ProductRequest $request)
    {
        $attributes = $request->all();

        if ($request->image != $product->image) {

            $attributes['image'] = $this->uploadTheImage($request, "image", "images/products/");
        }

        $attributes['updated_by'] = auth()->id();

        $product->update($attributes);

        return new productResource($product);
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

    public function selectAll()
    {
        return Product::pluck('id');
    }

    public function export($products)
    {
        $products = explode(',', $products);

        return (new ProductExport($products));
    }

    public function updateBarcode(Product $product, Request $request)
    {
        $attributes = $request->validate([
            'product_id' => ['required', 'string', 'min:3', 'max:100', Rule::unique('products')->ignore($product->id)],
        ]);

        $product->update($attributes);

        return new productResource($product);
    }
}
