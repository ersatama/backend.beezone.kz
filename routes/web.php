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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login_check', 'LoginController@getByPhone')->name('phone.check');
Route::post('/auth','LoginController@auth')->name('auth');
Route::get('/referral/{token}', 'UserController@referral')->name('user.referral');
Route::get('/block_user/{id}','UserController@block')->name('user.block');
Route::get('/active_user/{id}','UserController@active')->name('user.active');
Route::get('/delete_user/{id}','UserController@delete')->name('user.delete');
Route::get('/restore_password/{phone}','UserController@restorePassword')->name('user.password.restore');
Route::get('/get_restore_code/{phone}','UserController@getCode')->name('user.getCode');
Route::get('/change_password/{phone}/{password}','UserController@changePassword')->name('user.password.change');
//Route::get('/login', 'LoginController@show')->name('login');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
