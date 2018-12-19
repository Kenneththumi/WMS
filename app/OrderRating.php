<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderRating extends Model
{
    protected $table ='order_ratings';

    protected $fillable =['order_id','grammar','originality','instructions','speed'];

    public function order(){
        return $this->belongsTo('App\Order');
    }
}
