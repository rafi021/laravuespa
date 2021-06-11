<?php

use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\SubCategoryController;
use App\Http\Controllers\API\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('category', CategoryController::class);
Route::get('categories', [CategoryController::class, 'all']);

Route::apiResource('subcategory', SubCategoryController::class);
Route::get('/subcategories', [SubCategoryController::class, 'all']);

Route::apiResource('product', ProductController::class);
Route::get('products', [ProductController::class, 'all']);
