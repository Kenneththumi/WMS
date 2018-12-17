<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileWriter extends Model
{
    protected $table = 'files_writers';

    protected $fillable = ['order_id', 'file_path'];



    public function order(){
        return $this->belongsTo('App\Order');
    }
}
