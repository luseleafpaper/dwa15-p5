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
        return $this->belongsToMany('App\Student'); 
    } 

    public function lessons() { 
        return $this->belongsToMany('App\Lesson')->withTimestamps() ; 
    } 

    /* End Relationship Methods */
    public function getScheduleAsTeacher($teacher) { 
        $lessons = $this->lessons()->orderBy('start_time')->get(); 

        foreach($lessons as $lesson){ 
            if($lesson->students->count()==0 )
                { $lesson->status= 'AVAILABLE'; }
            else
                { $lesson->status= 'BUSY'; }
        } 
        return $lessons; 
    } 
 
    public function getScheduleAsStudent($student) { 
        $lessons = $this->lessons()->orderBy('start_time')->get(); 

        foreach($lessons as $lesson){ 
            if($lesson->students->contains($student->id))
                { $lesson->status = 'ATTENDING'; }
            else if($lesson->students->count()==0 )
                { $lesson->status= 'AVAILABLE'; }
            else
                { $lesson->status= 'BUSY'; }
        } 
        return $lessons; 
    } 

    public function getAllStudents() { 
        return Student::with('user')->get(); 
    } 
    public function getMyStudents() { 
        return $this->students()->with('user')->get(); 
    }
    
    public function getAllTeachers() { 
        return Teacher::with('user')->get(); 
    } 
    public function teachersForCheckboxes() {

        $teachers = Teacher::with('user')->get();
        $teachers_for_checkboxes = [];
        foreach($teachers as $teacher) {
            $teachers_for_checkboxes[] = $teacher;
        }
        return $teachers_for_checkboxes;

    }

    
}
