<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = ['user_id','order_id'];

    public function order(){
        return $this->belongsTo('App\Order');
    }
}
