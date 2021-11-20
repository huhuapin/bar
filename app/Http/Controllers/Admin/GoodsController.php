<?php

namespace App\Http\Controllers\Admin;

use App\Goods;
use App\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $goods = Goods::all();
        return view('admin/goods/list')->with([
            'goods'=>$goods
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
        $types = Type::all();
        return view('admin/goods/add')->with([
            'types'=>$types
        ]);
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

        if($request->file('img')){
            $image = $request->file('img')->store('public/img');
        }else{
            $image = "";
        }
        Goods::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'img'=>$image,
            'type_id'=>$request->type,
            'price'=>$request->price,
            'remain'=>$request->remain
        ]);
        $request->session()->flash('success',"添加商品【{$request->name}】成功！");
        return redirect('goods');
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
    public function edit(Goods $good)
    {
        //
        $types = Type::all();
        return view('admin/goods/edit')->with([
            'goods'=>$good,
            'types'=>$types,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Goods $good)
    {
        //
        $good->name = $request->name;
        $good->description = $request->description;
        if ($request->file('img')) {
            $good->img = $request->file('img')->store('img','public');
        }
        $good->type_id = $request->type;
        $good->price = $request->price;
        $good->save();
        $request->session()->flash('success',"更新商品【{$request->name}】成功！");
        return redirect('goods');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goods $goods,Request $request)
    {
        //
        $goods->delete();
        $request->session()->flash('success',"删除商品【{$goods->name}】成功！");
        return redirect('goods');
    }
}
