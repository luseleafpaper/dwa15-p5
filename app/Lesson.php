<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Teacher;

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
    public function teacherIDsForThisLesson() { 
        $teachers = $this->teachers; 
        $ret = []; 
        foreach($teachers as $teacher) { 
            $ret[] = $teacher->id; 
        } 
        return $ret;
    } 
}
