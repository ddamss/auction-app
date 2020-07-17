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

Route::get('/home', function(){
    return view('home');
})->name('home');


Route::resource('buyer', 'BuyerController')->only([
    'show','edit','update','destroy' 
]);


// Route::get('/{route}',function($route){

//     // $route=Route::current()->uri;
//     if($route=='buyer'){
//         return 'buyer here';
//     }else if ($route=='seller'){
//         return 'seller';
//     }else{
//         abort(404);  //404 page
//     }
//     // dd(Route::current()->uri);


// });