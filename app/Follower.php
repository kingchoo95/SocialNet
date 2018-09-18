<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    //

    protected $fillable =[

    	'user_id',
    	'followers_id',
    	

    ];

    public function user(){

        return $this->belongsTo('App\User');

    }

   
}
