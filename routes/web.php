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
    return view('home');
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
])->middleware('auth:seller,buyer');

Route::resource('auctions', 'AuctionController')->only([
    'index', 'show'
]);

Route::get('/my-auctions','AuctionController@myAuctions')->middleware('auth:buyer')->name('auctions.my-auctions');

Route::get('/time',function(){
    // $time= new DateTime("now");
    // return 'time '.$time->format('d/m/y H:i:s');
    $info = getdate();
    $time=new DateTime("now");
    // return date("Y-m-d",$time);
    // return $info;
    // return date_default_timezone_get ();
    $now=time();
    date_default_timezone_set('Asia/Dubai');
    $formattedNow=date("Y/m/d H:i:s",$now);
    return $formattedNow;
    
});

// Route::get('date', function () {
//     return view('datepicker');
// });

// Route::get('date2', function () {
//     return view('datetimepicker2');
// });

// Route::get('test', function () {
//     return view('auctions.show_auction');
// });