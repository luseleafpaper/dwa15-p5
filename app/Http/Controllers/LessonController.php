<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Session;
use App\Teacher;
use App\Student;


class LessonController extends Controller
{
    public function index(Request $request) 
    { 
        $user = Auth::user(); 
        dump("Lesson index: user, teacher, and student info");
        $teacher = $user->teacher()->first();

        if($teacher) { 
            dump($user->first_name." is teaching the following lessons");
            $lessons = $teacher->lessons()->get(); 
            dump($lessons);
        } else { 
            dump("Not a teacher");
        }     
        
        $student = $user->student()->first();
        
        if($student) {
            dump($user->first_name." is a student in the following lessons"); 
            $lessons = $student->lessons()->get(); 
            dump($lessons);
        } else { 
            dump("Not a student");
        }     
        
    } 
}
