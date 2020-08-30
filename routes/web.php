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

//GET ALL BRANDS
Route::get('/brands','BrandsController@list')->name('brands');

//GET BRAND BY ID
Route::get('/brands/{id}','BrandsController@getBrandById')->name('brands.id');

//GET CATEGORY BY BRAND_ID
Route::get('/category/{brandId}','CategoryController@getByBrandId')->name('category');

//GET CATEGORY BY ID
Route::get('/category/item/{id}','CategoryController@getById')->name('category.item');

//GET MATRIX PRICE BY CATEGORY_ID
Route::get('/matrix/{id}','MatrixController@getMatrixByCategoryId')->name('matrix.category');

//GET CATEGORY BY BRAND_ID AND GOODS_ID
Route::get('/category/{brandId}/{goodsId}','CategoryController@getByBrandIdAndGoodsId')->name('categoryAndGoods');

//GET USER INFO
Route::get('/edit','UserController@get')->name('user.info');

//SAVE USER INFO
Route::post('/save','UserController@store')->name('user.save');

//CHECK USER BY PHONE
Route::get('/login_check', 'LoginController@getByPhone')->name('phone.check');

//AUTH USER
Route::post('/auth','LoginController@auth')->name('auth');

//REGISTER NEW USER
Route::post('/new_user', 'UserController@register')->name('user.register');

//REFERRAL CHECK
Route::get('/referral/{token}', 'UserController@referral')->name('user.referral');
Route::get('/block_user/{id}','UserController@block')->name('user.block');
Route::get('/active_user/{id}','UserController@active')->name('user.active');
Route::get('/delete_user/{id}','UserController@delete')->name('user.delete');
Route::get('/restore_password/{phone}','UserController@restorePassword')->name('user.password.restore');
Route::get('/get_restore_code/{phone}','UserController@getCode')->name('user.getCode');
Route::get('/verify_code','UserController@verifyCode')->name('user.code');
Route::get('/change_password/{phone}/{password}','UserController@changePassword')->name('user.password.change');
//Route::get('/login', 'LoginController@show')->name('login');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
