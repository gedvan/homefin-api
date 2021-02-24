<?php

use App\Http\Controllers\CategoriesController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('teste', [CategoriesController::class, 'teste']);

Route::get('categories', [CategoriesController::class, 'list']);
Route::get('categories/{category}', [CategoriesController::class, 'show']);
Route::post('categories', [CategoriesController::class, 'create']);
Route::put('categories/{category}', [CategoriesController::class, 'update']);
Route::delete('categories/{category}', [CategoriesController::class, 'delete']);
