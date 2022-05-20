<?php

use App\Http\Controllers\Api\BatchController;
use App\Http\Controllers\Api\GiftController;
use App\Http\Controllers\RemovingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
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

    Route::get('reporting',[BatchController::class,'reporting'])->name('reporting');
    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('batchs',[BatchController::class,'index'])->name('batchs');


    Route::post('search/batch',[BatchController::class,'getBatchFromDate'])->name('searchBatch');
    Route::post('update/batch/{id}',[BatchController::class,'updateBatch'])->name('updateBatch');
    Route::post('new/batch',[BatchController::class,'addNewBatch'])->name('newBatch');
    Route::post('batch/interval',[BatchController::class,'interval'])->name('batchInterval');
    Route::post('send/email',[userController::class,'sendEmail'])->name('sendEmail');
   
});

Route::get('/gift/reporting',[GiftController::class,'reporting'])->name('giftReporting');
Route::get('/gift/get',[GiftController::class,'getGift'])->name('getGift');
Route::get('/gift/delete/{id}',[GiftController::class,'deleteGift'])->name('deleteGift');
Route::get('/gift/get/{id}',[GiftController::class,'getTheGift'])->name('getTheGift');

Route::post('/gift/interval',[GiftController::class,'getFromDate'])->name('giftInterval');
Route::post('gift/add',[GiftController::class,'store'])->name('addGift');
Route::post('/gift/update/{id}',[GiftController::class,'updateGift'])->name('updateGift');