<?php

use App\Http\Controllers\Api\BatchController;
use App\Http\Controllers\RemovingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;

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

Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('users', userController::class)->except('store');
    Route::get('search/batch',[BatchController::class,'getBatchFromDate'])->name('searchBatch');
    Route::post('update/batch/{id}',[BatchController::class,'updateBatch'])->name('updateBatch');
    Route::post('new/batch',[BatchController::class,'addNewBatch'])->name('newBatch');
});


