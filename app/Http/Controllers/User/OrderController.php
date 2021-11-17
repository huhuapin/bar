<?php

namespace App\Http\Controllers\User;

use App\Goods;
use App\Member;
use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders = Order::whereDate('created_at',today())->get();
        $details = [];
        foreach ($orders as $order){
            foreach ($order->details as $detail) {
                $detail->goods;
            }
            array_push($details,$detail);
        }
        return view('user/orderlist')->with([
            'orders'=>$orders,
        ]);

    }

    public function today(){
        $orders = Order::whereDate('created_at',today())->get();
        $details = [];
        foreach ($orders as $order){
            foreach ($order->details as $detail) {
                $detail->goods;
            }
            array_push($details,$detail);
        }
        return [
            'orders'=>$orders,
            'details'=>$details,
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function store(Request $request)
    {
        //
//        var_dump($request);
        DB::beginTransaction();
        try {
            //创建订单
            $order = new Order();
            $order->user_id = Auth::id();
            $order->total_count = sizeof($request->cartlist);
            $order->total_price = 0;
            foreach ($request->cartlist as $item) {
                $order->total_price += $item[2] * $item[3];
            }
            $order->table_number = $request->table_num;
            $order->discount = $request->discount;
            $order->real_price = $order->total_price * $order->discount;
            $order->remark = $request->other;
            //获取会员账号,减少金额
            if ($request->tel != null) {
                $member = Member::where(['tel' => $request->tel])->first();

                if ($member == null){
                    return [
                        'message'=>"会员号码不存在",
                        'code'=>500
                    ];
                }

                $member_id = $member ? $member->id : null;
                $order->member_id = $member_id;
                $member->account -= $order->real_price;
                $member->save();
            }

            if ($order->total_count == 0) {
                return [
                    'message' => '商品数量不能为0',
                    'code'=> 500
                ];
            }

            $order->save();
            //订单明细
            foreach ($request->cartlist as $item) {
                //管理订单与商品
                $order_detail = new OrderDetail();
                $order_detail->order_id = $order->id;
                $order_detail->goods_id = $item[0];
                $order_detail->price = $item[2];
                $order_detail->num = $item[3];
                $order_detail->total_price = $item[2] * $item[3];
                $order_detail->save();

                //减少商品
                $goods = Goods::find($item[0]);
                $goods->remain -= $item[3];
                $goods->save();
            }
            DB::commit();
            $message = "消费成功，共消费{$order->real_price}元";
            if ($order->member_id) {
                $message .= "，账户剩余{$member->account}元";
            }
            return [
                'message' => $message,
                'code' => 200,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
//            return [
//                'message'=> $e,
//                'code'=>500
//            ];
            return $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
