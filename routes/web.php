<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function () {
    return view('home');
})->name('home');


Route::resource('buyer', 'BuyerController')->only([
    'show', 'update', 'destroy'
]);

Route::resource('auctions', 'AuctionController')->only([
    'index', 'store', 'show', 'create', 'destroy'
])->middleware('auth:seller');


Route::resource('auctions', 'AuctionController')->only([
    'index', 'show', 'update'
])->middleware('auth:buyer');

Route::get('date', function () {
    return view('datepicker');
});

Route::get('date2', function () {
    return view('datetimepicker2');
});
