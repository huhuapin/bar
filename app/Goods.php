<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //
    protected $table = "goods";

    protected $guarded = [];
    public function type(){
        return $this->belongsTo('App\Type');
    }
}
