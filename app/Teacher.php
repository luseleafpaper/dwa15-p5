<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    /**
    *
    */

    /* Begin Relationship Methods */ 
    // One to One between User and Teacher 
    public function user() {
        return $this->belongsTo('App\User');
    }
    // Many to Many between student and teacher 
    public function students() { 
        return $this->belongsToMany('App\Students'); 
    } 

    /* End Relationship Methods */

}
