<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Session;
use App\Teacher;
use App\Student;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        dump("Lesson index: user and student info");

        dump($user); 
        $student = $user->student()->first();

        if($student) {
            dump($user->first_name." is a student");
            dump($student->toArray() );
            dump("... who studies with...");
            $teachers = $student->teachers()->get();
            dump($teachers);
        } 
        else {
            dump($user->first_name." is not a student");
        }

    }

}
