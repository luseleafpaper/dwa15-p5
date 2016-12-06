<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /* Begin Relationship Methods */ 
    // One to one between User and Student 
    public function user() {
        return $this->belongsTo('App\User');
    }
    
    // Many to Many between student and teacher 
    public function teachers() { 
        return $this->belongsToMany('App\Teacher'); 
    } 
    /* End Relationship Methods */

}
