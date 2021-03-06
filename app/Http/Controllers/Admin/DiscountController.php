<?php

namespace App\Http\Controllers\Admin;

use App\Discount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $discount = Discount::orderBy('discount','DESC')->get();
        return view('admin/discount/list')->with([
            'discounts'=>$discount
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin/discount/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Discount::create([
            'discount'=>$request->discount,
            'description'=>$request->description
        ]);
        $request->session()->flash('success','添加折扣成功！');
        return redirect('discount');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        //
        return view('admin/discount/edit')->with([
            'discount'=>$discount
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount)
    {
        //
        $discount->discount = $request->discount;
        $discount->description = $request->description;
        $discount->save();
        $request->session()->flash('success','修改折扣成功！');
        return redirect('discount');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount,Request $request)
    {
        //
        $discount->delete();
        $request->session()->flash('success','删除折扣成功！');
        return redirect('discount');
    }
}
