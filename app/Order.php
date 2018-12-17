<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
        protected $fillable = [
                                'order_id',
                                'due_date',
                                'discipline',
                                'topic',
                                'sources' ,
                                'style' ,
                                'pages' ,
                                'words' ,
                                'instructions',
                                'amount',
                                'status',
                                'paper_type',
                                'writing_type',
                                'level',
                                'user_id',
                              ];

        public  $paperType = [
            ''=> '- select -',
            'essay(any type)'=> 'Essay(any type)',
            'research paper'=> 'Research Paper',
            'research proposal'=>'Research Proposal',
            'term paper'=> 'Term Paper',
            'capstone'=>'Capstone',
            'annotated bibliography'=>'Annotated Bibliography',
            'admission essay'=>'Admission Essay',
            'article review'=>'Article Review',
            'book/movie review'=>'Book/Movie Review',
            'business plan'=>'Business Plan',
            'case study'=>'Case Study',
            'course work'=>'Course Work',
            'creative writing'=>'Creative Writing',
            'critical thinking'=>'Critical Thinking',
            'presentation or speech'=>'Presentation or Speech',
            'thesis/desertation chapter' => 'Thesis/Desertation Chapter',
            'other' => 'Other',
        ];



        public function files(){
            return $this->hasMany('App\File');
        }

        public function user(){
            return $this->belongsTo('App\User');
        }

        public function filewriter(){
            return $this->hasOne('App\FileWriter');
        }

        public function messages(){
            return $this->hasMany('App\Message');
        }
        public function applications(){
           return$this->hasMany('App\Application');
        }
        //checks if order is editable
        public function editable(){
            if($this->status == 'current' || $this->status == 'revision' || $this->status == 'available'){
                return true;
            }

            return false;
        }
        //checks if order is re-assignable
        public function assignable(){
            if($this->status == 'current' || $this->status == 'revision' || $this->status == 'available' || $this->status == 'cancelled'){
                return true;
            }

            return false;
        }
        //check if at current state, if the order is deletable
        public function deletable(){
            if($this->status == 'available' || $this->status == 'cancelled'|| $this->status == 'completed'){
                return true;
            }

            return false;
        }
       //check if order is available for applying
        public function isOrderAvailable(){
            if($this->status == 'available'){
                return true;
            }

            return false;
        }


}
