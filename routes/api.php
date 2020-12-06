<?php

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
Route::get('get_alltransaction',[App\Http\Controllers\TransactionController::class,'get_transaction']);
Route::get('get_singletransaction/{transaction_id}',[App\Http\Controllers\TransactionController::class,'get_singletransaction']);
Route::post('transaction/create',[App\Http\Controllers\TransactionController::class,'create_transaction']);

