<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    //

    public function index(){
        $orders = Order::orderBy('created_at','DESC')->get();
        return view('admin/order/list')->with([
            'orders'=>$orders
        ]);
    }
    public function show(Order $order){
        return view('admin/order/detail')->with([
            'order'=>$order
        ]);
    }
    public function destroy(Request $request,Order $order) {
        OrderDetail::where('order_id',$order->id)->delete();
        $order->delete();
        $request->session()->flash('success','删除订单成功！');
        return redirect('adminOrder');
    }
}
