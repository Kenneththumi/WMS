<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected  $fillable = ['order_id','file_path','link'];


    public function order(){
        return $this->belongsTo('App\Order');
    }
}
