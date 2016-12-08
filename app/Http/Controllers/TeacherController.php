<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Session;
use App\Teacher;
use App\Student;


class TeacherController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        dump("Lesson index: user and teacher info");
        dump($user); 
        $teacher = $user->teacher()->first();

        if($teacher) {
            dump($user->first_name." is a teacher");
            dump($teacher->toArray() );
            dump("... who teaches...");
            $students = $teacher->students()->get();
            dump($students);
        } else {
            dump("Not a teacher");
        }

    }

}
