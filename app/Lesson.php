<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    //
    /* Begin Relationship Methods */
    // Many to Many lessons to students 
    public function students(){ 
       return $this->belongsToMany('App\Student')->withTimestamps();
    }   

    public function teachers() { 
        return $this->belongsToMany('App\Teacher')->withTimestamps(); 
    } 
    /* End Relationship Methods */
}
