<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoriesController;
use App\Http\Controllers\API\CustomersController;
use App\Http\Controllers\API\UsersController;
use App\Http\Resources\UserResource;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('categories', CategoriesController::class);
    Route::apiResource('users', UsersController::class);

    Route::get('/customers/selectAll', [CustomersController::class, 'selectAll']);
    Route::get('/customers/export/{customers}', [CustomersController::class, 'export']);
    Route::apiResource('customers', CustomersController::class);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return new UserResource($request->user());
});
