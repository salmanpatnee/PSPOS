<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BrandController;
use App\Http\Controllers\API\BusinessController;
use App\Http\Controllers\API\CategoriesController;
use App\Http\Controllers\API\CurrencyController;
use App\Http\Controllers\API\CustomersController;
use App\Http\Controllers\API\LocationController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\PurchaseController;
use App\Http\Controllers\API\SuppliersController;
use App\Http\Controllers\API\TaxController;
use App\Http\Controllers\API\UsersController;
use App\Http\Resources\UserResource;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('categories', CategoriesController::class);
    Route::apiResource('brands', BrandController::class);
    Route::apiResource('taxes', TaxController::class);
    Route::apiResource('users', UsersController::class);

    Route::get('/customers/selectAll', [CustomersController::class, 'selectAll']);
    Route::get('/customers/export/{customers}', [CustomersController::class, 'export']);
    Route::apiResource('customers', CustomersController::class);

    Route::apiResource('suppliers', SuppliersController::class);
    Route::apiResource('business', BusinessController::class)->except(['store', 'destroy']);
    Route::apiResource('locations', LocationController::class);
    Route::apiResource('currencies', CurrencyController::class)->except(['show', 'store', 'update', 'destroy']);

    Route::get('/products/selectAll', [ProductController::class, 'selectAll']);
    Route::get('/products/export/{products}', [ProductController::class, 'export']);
    Route::put('/products/barcode/{product}', [ProductController::class, 'updateBarcode']);
    Route::apiResource('products', ProductController::class);

    Route::apiResource('purchases', PurchaseController::class);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return new UserResource($request->user());
});
