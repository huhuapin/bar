<?php

namespace App\Http\Controllers\Admin;

use App\Notice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoticeController extends Controller
{
    //
    public function edit(){
        $notice = Notice::first();
        if ($notice == null) {
            $notice = new Notice();
        }
        return view('admin/notice/edit')->with([
            'notice'=>$notice
        ]);
    }
    public function update(Request $request){
        $notice = Notice::first();
        if ($notice == null) {
            $notice = new Notice();
        }
        $notice->title = $request->title;
        $notice->notice = $request->notice;
        $notice->save();
        $request->session()->flash('success','修改公告成功！');
        return redirect('notice/edit');
    }
}
