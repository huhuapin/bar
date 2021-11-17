<?php

namespace App\Http\Controllers\User;

use App\Deposit;
use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('user/member');
    }

    public function my(){
        $id = Auth::id();
        $members = Member::where('user_id',$id)->get();
        return $members;
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
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(Request $request)
    {
        //
        $message = "";
        $member = Member::where('tel',$request->tel)->first();
        if (!$member){
            $member = new Member();
            $member->tel = $request->tel;
            $member->account = $request->number;
            $member->remark = $request->other;
            $message = "新开会员成功，卡内金额".$member->account."元";
            $type = 0;
        }else {
            $member->account += $request->number;
            $message = "充值成功，剩余金额".$member->account."元";
            $type =1;
        }
        $member->name = $request->name;
        $member->save();

        Deposit::create([
            "member_id"=>$member->id,
            'money' => $request->number,
            'type' => $type,
        ]);
        return [
            'message'=>$message,
            'code'=>200,
            'data'=>$member,
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $member = Member::where(['tel'=>$id])->first();
        return $member;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if ($id > 0 ){
            $member = Member::find($id);
        }else{
            $member = new Member();
        }
        return view('user/addmember')->with([
            'member'=>$member
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
