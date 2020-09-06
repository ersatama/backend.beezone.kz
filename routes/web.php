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
    /*$pro = Illuminate\Support\Facades\DB::table('users_test')->get();
    echo '<pre>';
    foreach ($pro as $key=>$val) {
        $val = (array) $val;
        print_r($val);
        Illuminate\Support\Facades\DB::table('users')->insert([[
            'name'             =>  $val['name'],
            'birthdate'          =>  date('Y-m-d'),
            'phone'     =>  $val['phone'],
            'phone_verified_at' =>  date('Y-m-d'),git
            'email'         =>  $val['email'],
            'email_verified_at' =>  $val['email_verified_at'],
            'address'       =>  $val['address'],
            'token'        =>  'U',
            'avatar'  =>  $val['avatar'],
            'avatar_original'  =>  $val['avatar_original'],
            'password'          => $val['password'],
            'email_notification'    => 0,
            'push_notification'     => 0,
            'del'               =>  'active',
        ]]);
    }
    exit;
    //php artisan migrate:refresh --path=/database/migrations/2014_10_12_000000_create_users_table.php
    return $pro;*/
    /*$pro = Illuminate\Support\Facades\DB::table('products_test')->get();
    echo '<pre>';
    foreach ($pro as $key=>$val) {
        $val = (array) $val;
        Illuminate\Support\Facades\DB::table('goods')->insert([[
            'title'             =>  $val['name'],
            'title_1c'          =>  $val['name'],
            'thumbnail_img'     =>  $val['thumbnail_img'],
            'featured_img'      =>  $val['featured_img'],
            'flash_img'         =>  $val['flash_deal_img'],
            'tags'              =>  $val['tags'],
            'description'       =>  $val['description'],
            'meta_title'        =>  $val['meta_title'],
            'meta_description'  =>  $val['meta_description'],
            'meta_img'          =>  $val['meta_img'],
            'del'               =>  'active',
        ]]);
    }
    exit;
    //php artisan migrate:refresh --path=/database/migrations/2014_10_12_000000_create_users_table.php
    return $pro;*/
    return view('welcome');
});

Route::get('/search/{text}','SearchController@search')->name('search');

//GET ALL BRANDS
Route::get('/brands','BrandsController@list')->name('brands');

//GET BRAND BY ID
Route::get('/brands/{id}','BrandsController@getBrandById')->name('brands.id');

//GET CATEGORY BY BRAND_ID
Route::get('/category/{brandId}','CategoryController@getByBrandId')->name('category');

//GET DEALERS LIST
Route::get('/dealers','UserController@dealers')->name('dealers');

//GET SUB DEALERS LIST
Route::get('/sub_dealers','UserController@subDealers')->name('subDealers');

//GET DEALER INFO
Route::get('/dealer/{id}','UserController@dealerInfo')->name('dealerInfo');

//STORE NEW ORDER
Route::post('/order/save','OrderController@store')->name('order.store');

//GET INFO COUNT SUM PROFIT
Route::get('/order','OrderController@main')->name('order.main');

//GET ORDER LIST
Route::get('/order/list','OrderController@list')->name('order.list');

//GET ORDER ALL
Route::get('/order/all','OrderController@all')->name('order.all');

//GET ORDER DETAIL
Route::get('/order/detail/{id}','OrderController@detail')->name('order.detail');

//SET ORDER STATUS
Route::get('/order/status/{id}','OrderController@status')->name('order.status');

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
