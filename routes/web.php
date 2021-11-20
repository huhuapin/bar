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

Route::get('/login', function () {
    return view('login');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('login');
});

Route::get('/','LoginController@index');

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
    Route::resource('member','MemberController',['except'=>
        ['destroy']]);
    Route::resource('order','OrderController');
    Route::resource('mine','MineController');
    Route::get('todayOrder','OrderController@today');
    Route::get('discountJson','OrderController@discount');
});


Route::get('index',['as'=>'adminIndex','uses'=>'Admin\AdminController@index']);
Route::get('index_v1',['as'=>'adminIndex','uses'=>'Admin\AdminController@index_v1']);



Route::group([
    'middleware'=>'checkAdmin',
],function (){

    //用户管理
    Route::resource('user','Admin\UserController', ['except' =>
        ['destroy']
    ]);
    Route::get('user/{user}/delete','Admin\UserController@destroy');

    //类型管理
    Route::resource('type','Admin\TypeController', ['except' =>
        ['destroy']
    ]);
    Route::get('type/{type}/delete','Admin\TypeController@destroy');

    //商品管理
    Route::resource('goods','Admin\GoodsController', ['except' =>
        ['destroy']
    ]);
    Route::get('goods/{goods}/delete','Admin\GoodsController@destroy');

    //折扣
    Route::resource('discount','Admin\DiscountController',['except'=>
    ['destroy']]);
    Route::get('discount/{discount}/delete','Admin\DiscountController@destroy');

    //公告
    Route::get('notice/edit','Admin\NoticeController@edit');
    Route::post('notice','Admin\NoticeController@update');

    //人员查询
    Route::get('memberList','User\MemberController@list');
    Route::get('member/{member}/delete','UserController@destroy');

    //订单
    Route::get('adminOrder','Admin\OrderController@index');
    Route::get('adminOrder/{order}','Admin\OrderController@show');
    Route::get('adminOrder/{order}/delete','Admin\OrderController@destroy');


});