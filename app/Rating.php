<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected  $fillable = ['user_id','grammar','conversion','instructions','speed','total','completed'];


    public function user(){
        return $this->belongsTo('App\User');
    }
}
