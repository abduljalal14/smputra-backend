<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::post('/login', 'Api\LoginController@index');
Route::post('/login', [LoginController::class, 'index']);
Route::get('/logout', [LoginController::class, 'logout']);
// Route::get('/logout', 'Api\LoginController@logout');

Route::apiResource('/products', App\Http\Controllers\Api\ProductController::class);
Route::apiResource('/categories', App\Http\Controllers\Api\CategoryController::class);
Route::apiResource('/orders', App\Http\Controllers\Api\OrderController::class);
Route::get('/order/id/{order_id}', [App\Http\Controllers\Api\OrderController::class, 'showById']);
Route::apiResource('/order_details', App\Http\Controllers\Api\OrderDetailController::class);
Route::apiResource('/banners', App\Http\Controllers\Api\BannerController::class);



