<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function login(Request $request) {
        if (count(User::get()) == 0) {
            $user = new User();
            $user->tel = $request->tel;
            $user->name = "管理员";
            $user->password = bcrypt($request->password);
            $user->status = 0;
            $user->save();
            session(['user'=>$user]);
            return redirect()->route('index');
        }else {
            $user = User::where(['tel'=>$request->tel])->first();
            $user->password = bcrypt($request->password);
            $user->save();
            if(\Auth::attempt(['tel'=>$request->tel,'password'=>$request->password]))
            {
                //此数组会和对应模型的数据库进行匹配,匹配正确会进入到此分支语句中
                return redirect('/');
            }else{
                dd("用户名密码错误");
            }
        }
    }
    public function index(Request $request){
        if (!Auth::check()) {
            return redirect('login');
        }else{
            if (Auth::user()->status == 0) {
                return redirect('cartList');
            }else {
                return redirect('index');
            }
        }
    }
}
