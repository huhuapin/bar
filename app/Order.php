<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    //
    protected $table = "order";
    public function details(){
        return $this->hasMany('App\OrderDetail');
    }
    public function goods(){
        return $this->belongsToMany('App\Goods','order_detail');
    }

    public function member(){
        return $this->belongsTo('App\Member');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public static function getByDate($start,$end) {
        return DB::table('order')->whereBetween('created_at',[$start,$end])
                ->selectRaw('DATE(created_at) as date, SUM(real_price) as all_price,COUNT(*) as all_count')
                ->groupBy('date')->get();
    }
}
