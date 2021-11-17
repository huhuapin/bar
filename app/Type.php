<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    //
    protected $table = "type";
    public function goods(){
        return $this->hasMany('App\Goods','type_id','id');
    }

}
