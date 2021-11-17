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
    return view('login');
});

Route::post('login',['as'=>"login",'uses'=>"LoginController@login"]);
Route::group([
    'middleware'=>'checkUser',
    'namespace'=>'User',
],function () {
    // 在 "App\Http\Controllers\Admin" 命名空间下的控制器
    Route::get('cartList',['as'=>'cartList','uses'=>"CartController@index"]);
    Route::get('cart',function (){
        return view('user/order');
    });
    Route::get('/myMember',['as'=>'myMember','uses'=>"MemberController@my"]);
    Route::resource('member','MemberController');
    Route::resource('order','OrderController');
    Route::resource('mine','MineController');
    Route::get('todayOrder','OrderController@today');
});

Route::resource('discount','Admin\DiscountController');

Route::get('index',['as'=>'adminIndex','uses'=>'Admin\AdminController@index']);
Route::get('index_v1',['as'=>'adminIndex','uses'=>'Admin\AdminController@index_v1']);