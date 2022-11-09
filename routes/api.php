<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryApiController;
use App\Http\Controllers\ProductApiController;
use App\Http\Controllers\GoogleSearchController;
use App\Http\Controllers\CartApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('getCategory', [CategoryApiController::class, 'GetCategory']);
Route::put('updateCategory/{id}', [CategoryApiController::class, 'UpdateCategory']);
Route::delete('deleteCategory/{id}', [CategoryApiController::class, 'DeleteCategory']);
Route::get('searchCategory', [CategoryApiController::class, 'SearchCategory']);

Route::get('getProduct', [ProductApiController::class, 'GetProduct']);
Route::put('updateProduct/{id}', [ProductApiController::class, 'UpdateProduct']);
Route::delete('deleteProduct/{id}', [ProductApiController::class, 'DeleteProduct']);
Route::put('blockProduct/{id}', [ProductApiController::class, 'blockProduct']);
Route::put('unblockProduct/{id}', [ProductApiController::class, 'unblockProduct']);
Route::get('getProduct/{id}', [ProductApiController::class, 'GetProductById']);
Route::get('searchProduct', [ProductApiController::class, 'SearchProduct']);

Route::get('getCart', [CartApiController::class, 'GetCart']);
Route::post('addToCart/{id}/{userName}', [CartApiController::class, 'AddToCart']);
Route::put('update/{userName}/{cartId}/{updatedQuantity}', [CartApiController::class, 'Update']);