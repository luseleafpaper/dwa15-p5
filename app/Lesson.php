<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    //
    /* Begin Relationship Methods */
    // Many to Many lessons to students 
    public function students() { 
        $this->belongsToMany('App\Student')->withTimestamps() ; 
    }   

    public function teachers() { 
        $this->belongsToMany('App\Teacher')->withTimestamps(); 
    } 
    /* End Relationship Methods */
}