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
    
    public function show(Request $request, $id) { 
        $teacher = Teacher::find($id); 
        // try to see if user is student
        $user = Auth::user(); 
        $student = $user->student()->first(); 
        if($student) { 
            $teachers = $student->teachers()->get(); 
            if($teachers->contains($teacher->id)){ 
                dump("This student found the right teacher"); 
            } 
            else {dump("Teacher was not paired with this student"); }
        } 
        // else if student is paired with teacher. if not, abort 
        $schedule = $teacher->getScheduleAsStudent($student);  

        return view('teacher.show')->with([
            'schedule'=>$schedule,
            'teacher_user'=>$teacher->user
        ]);
    } 

}
