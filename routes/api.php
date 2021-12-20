<?php

use App\Http\Controllers\Api\v1\CurrencyController;
use App\Http\Controllers\Api\v1\RateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

//register new user
Route::post('/create-account', [AuthenticationController::class, 'createAccount']);
//login user
Route::post('/signin', [AuthenticationController::class, 'signin']);

Route::group(['middleware' => ['auth:sanctum', 'throttle:1500,1']], function () {
    Route::prefix('/rates')->group(function () {
        Route::get(
            '/specific/{req?}',
            [
                RateController::class,
                'apiLatestSpecificCurrency'
            ]
        )
            ->name('rates.specific');

        Route::get(
            '/dynamics/{req?}',
            [
                RateController::class,
                'apiDynamicsCurrencyRangeDates'
            ]
        )
            ->name('rates.specific');
    });
});

