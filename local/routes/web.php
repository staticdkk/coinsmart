<?php

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
    return redirect(url('login'));
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('login', 'LoginController@getLogin');
Route::post('login','LoginController@postLogin');
Route::get('logout', 'LoginController@logOut');

Route::get('register', 'RegisterController@getRegister');
Route::post('register','RegisterController@postRegister');

Route::resource('exchange','ExchangeController');
Route::resource('transaction','TransactionController');
Route::resource('info','InfoController');
Route::resource('coin','CoinController');
Route::post('/exchange/confirm', 'ExchangeController@confirm');
// message
Route::post('/exchange/addNewMessage', 'MessageController@addNewMessage');
Route::post('/exchange/getOldMessage', 'MessageController@getOldMessage');
Route::post('/exchange/getNewMessage', 'MessageController@getNewMessage');
Route::post('/exchange/updateCurrentId', 'MessageController@updateCurrentId');

//search 
Route::get('/selectSearchU', 'SearchAjax@dataAjaxU');
Route::get('/selectSearchM', 'SearchAjax@dataAjaxM');