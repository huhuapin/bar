<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //
    protected $table = "order_detail";
    public function goods(){
        return $this->belongsTo('App\Goods');
    }
}
