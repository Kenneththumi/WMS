<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'email','lname','passport','passport', 'password','image_path','tel','role','account'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public $proficiencies = [
                    ''=>' - select - ',
                'Accounting' => 'Accounting',
                'Agriculture' => 'Agriculture',
                'Anthropology'=> 'Anthropology',
                'Application Letters'=>'Application Letters',
                'Architecture, Building and Planning' => 'Architecture, Building and Planning',
                'Art (Fine arts, Performing arts)' => 'Art (Fine arts, Performing arts)',
                'Astronomy (and other Space Sciences)'=> 'Astronomy (and other Space Sciences)',
                'Aviation' => 'Aviation',
                'Biology (and other Life Sciences)'=>'Biology (and other Life Sciences)',
                'Business Studies'=>'Business Studies',
                'Chemistry'=>'Chemistry',
                'Civil Engineering'=>'Civil Engineering',
                'Classic English Literature'=>'Classic English Literature',
                'Communications'=>'Communications',
                'Composition'=>'Composition',
                'Computer Science'=>'Computer Science',
                'Criminal Justice'=>'Criminal Justice',
                'Criminal Law'=>'Criminal Law',
                'Cultural and Ethnic Studies'=>'Cultural and Ethnic Studies',
                'Ecology'=>'Ecology',
                'Economics'=>'Economics',
                'Education'=>'Education',
                'Engineering'=>'Engineering',
                'English 101'=>'English 101',
                'Environmental studies and Forestry'=>'Environmental studies and Forestry',
                'Ethics'=>'Ethics',
                'Family and consumer science'=>'Family and consumer science',
                'Film & Theater studies'=>'Film & Theater studies',
                'Finance'=>'Finance',
                'Geography'=>'Geography',
                'Geology (and other Earth Sciences)'=>'Geology (and other Earth Sciences)',
                'Health Care'=>'Health Care',
                'History'=>'History',
                'Human Resources Management (HRM)'=>'Human Resources Management (HRM)',
                'International Relations'=>'International Relations',
                'International Trade'=>'International Trade',
                'Investments'=>'Investments',
                'IT, Web'=>'IT, Web',
                'Journalism'=>'Journalism',
                'Law'=>'Law',
                'Leadership Studies'=>'Leadership Studies',
                'Linguistics'=>'Linguistics',
                'Literature'=>'Literature',
                'Logistics'=>'Logistics',
                'Management'=>'Management',
                'Marketing'=>'Marketing',
                'Mathematics'=>'Mathematics',
                'Medical Sciences (Anatomy, Physiology, Pharmacology etc.)'=>'Medical Sciences (Anatomy, Physiology, Pharmacology etc.)',
                'Medicine'=>'Medicine',
                'Music'=>'Music',
                'Nursing'=>'Nursing',
                'Nutrition/Dietary'=>'Nutrition/Dietary',
                'Philosophy'=>'Philosophy',
                'Physics'=>'Physics',
                'Poetry'=>'Poetry',
                'Political Science'=>'Political Science',
                'Psychology'=>'Psychology',
                'Public Administration',
                'Public Relations (PR)',
                'Religious Studies'=>'Religious Studies',
                'Shakespeare'=>'Shakespeare',
                'Social Work and Human Services'=>'Social Work and Human Services',
                'Sociology'=>'Sociology',
                'Sports'=>'Sports',
                'Statistics'=>'Statistics',
                'Technology'=>'Technology',
                'Theater Studies'=>'Theater Studies',
                'Tourism'=>'Tourism',
                'Urban Studies'=>'Urban Studies',
                'Women\'s and Gender studies'=>'Women\'s and Gender studies',
                'World Affairs'=>'World Affairs',
                'World Literature'=>'World literature',
                'Zoology'=>'Zoology'

];


    public function orders(){
        return $this->hasMany('App\Order');
    }

    public function rating(){
        return $this->hasOne('App\Rating');
    }

    public function moreinfo(){
        return $this->hasOne('App\MoreInfo');
    }


    public function isSuperAdmin(){
        if(auth()->user()->role == '3'){
            return true;
        }

        return false;
    }

    public function isAdmin(){
        if(auth()->user()->role == '2'){
            return true;
        }

        return false;
    }
    public function isWriter(){
        if(auth()->user()->role == '1'){
            return true;
        }

        return false;
    }

    public function isAccountActive(){
      if(!$this->getrole()){
          return false;
      }

      return true;
    }

    public function getrole(){
        if(auth()->user()->role == '1'){
            return 'writer';
        }
        elseif (auth()->user()->role =='2'){
            return 'admin';
        }
        elseif (auth()->user()->role == '3'){
            return'super admin';
        }else{
            return false;
        }

    }



}
