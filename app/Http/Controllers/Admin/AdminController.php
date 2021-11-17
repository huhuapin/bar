<?php

namespace App\Http\Controllers\Admin;

use App\Member;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function index(){
        return view('admin/index');
    }
    public function index_v1(){
        //获取今日订单
        $todayOrders = Order::whereDate('created_at',today())->get();

        $weekOrders = Order::getByDate(Carbon::today()->subWeek()->toDateTimeString(),now()->toDateTimeString());

        $todayMembers = Member::whereDate('created_at',today())->get();

        return view('admin/index_v1')->with([
            'todayOrders'=>$todayOrders,
            'todayMembers'=>$todayMembers,
            'weekOrders' => $weekOrders,
        ]);

    }
}
