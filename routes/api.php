<?php

use App\Auction;
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

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, X-Auth-Token, Origin, Authorization,X-Requested-With,x-socket-id');


Route::middleware('auth:api')->group(function () {
    Route::apiResource('/bid', 'BidController')->only([
        'store'
    ]);
});

    Route::post('auction-status/{id}', 'AuctionController@updateStatus', function ($id) {
        return Auction::find($id);
    });



Route::middleware('auth:api')->group(function () {
    Route::apiResource('/buyer', 'BuyerController')->only([
        'update'
    ]);
});