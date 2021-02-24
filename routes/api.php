<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TransactionsController;
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

Route::get('categories',  [CategoriesController::class, 'index']);
Route::post('categories', [CategoriesController::class, 'store']);
Route::get('categories/{category}',     [CategoriesController::class, 'show']);
Route::put('categories/{category}',     [CategoriesController::class, 'update']);
Route::delete('categories/{category}',  [CategoriesController::class, 'delete']);

Route::get('transactions',  [TransactionsController::class, 'index']);
Route::post('transactions', [TransactionsController::class, 'store']);
Route::get('transactions/{transaction}',    [TransactionsController::class, 'show']);
Route::put('transactions/{transaction}',    [TransactionsController::class, 'update']);
Route::delete('transactions/{transaction}', [TransactionsController::class, 'delete']);
