<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoreInfo extends Model
{
    protected $table = 'more_user_info';


    protected $fillable = ['tel2', 'city', 'previous_work', 'previous_work_timeline', 'availability', 'urgent_work', 'citations', 'highest_qualification', 'proficiencies', 'relevant_info'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
