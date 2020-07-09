<?php

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

Route::group(['prefix' => 'admin','namespace'=>'Admin'], function () {
   // Config::set('auth.defines', 'admin');
    Route::get('/','AdminAuth@login');
    Route::get('logout','AdminAuth@logout');
    Route::post('/','AdminAuth@doLogin');
    Route::get('home','NewsController@index');
////news routes
Route::get('create-new','NewsController@create'); 
Route::post('add-new','NewsController@store'); 
Route::get('lang/{lang}', function ($lang) {
    (session()->has('lang'))?session()->forget('lang'):'';
     ($lang=='ar')?session()->put('lang','ar'):session()->put('lang','en');
     return back();
 });
});
////front routes
Route::get('lang/{lang}', function ($lang) {
   (session()->has('lang'))?session()->forget('lang'):'';
    ($lang=='ar')?session()->put('lang','ar'):session()->put('lang','en');
    return back();
});
Route::get('/','NewsController@index');
Route::get('news_profile/{id}','NewsController@show');
