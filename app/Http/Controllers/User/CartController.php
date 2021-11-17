<?php

namespace App\Http\Controllers\User;

use App\Notice;
use App\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    //
    public function index(){
        $types = Type::get();
        foreach ($types as $type) {
            $type->goods;
        }
        $notice = Notice::first();
        return view('user/index')->with([
            'types'=>$types,
            'notice'=>$notice,
        ]);
    }
}
