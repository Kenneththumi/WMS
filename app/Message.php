<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['order_id', 'message'];

    public  function order(){
        return $this->belongsTo('App\Order');
    }
}
