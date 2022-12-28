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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('listener', [\App\Http\Controllers\Api\MessageController::class, 'handler']);

Route::group(['prefix' => 'sijaka', 'middleware' => 'sijaka.verify-apiKey'], function () {
    Route::group(['prefix' => 'train'], function () {
        Route::post('{train_code}/origin', [\App\Http\Controllers\Api\TrainController::class, 'set_origin']);
        Route::post('{train_code}/destination', [\App\Http\Controllers\Api\TrainController::class, 'set_destination']);
        Route::post('{train_code}/location', [\App\Http\Controllers\Api\TrainController::class, 'set_location']);
    });

    Route::group(['prefix' => 'station'], function () {
        Route::post('{station_code}/schedule/{train_code}/depart_time', [\App\Http\Controllers\Api\StationController::class, 'set_train_depart']);
        Route::post('{station_code}/schedule/{train_code}/arrive_time', [\App\Http\Controllers\Api\StationController::class, 'set_train_arrive']);
    });
});
