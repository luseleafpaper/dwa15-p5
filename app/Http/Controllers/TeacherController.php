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
        $student = $user->student()->first(); 
        $teacher = $user->teacher()->first(); 

        if($teacher) { 
            $teachers = $teacher->getAllTeachers();
        } 
        
        else if($student) { 
            $teachers = $user->student()->first()->teachers()->with('user')->get();
        } 

        return view('teacher.index')->with([
            'user'=>$user, 
            'teachers' => $teachers,
        ]); 

    }
    
    public function show(Request $request, $id) { 
        $teacher = Teacher::find($id); 
        // try to see if user is student
        $user = Auth::user(); 
        $student = $user->student()->first(); 
        $user_teacher = $user->teacher()->first(); 
        
        if($user_teacher) { 
            if($user_teacher->id==$id) { 
                Session::flash('flash_message', 'You are trying to view your own schedule');
                return redirect('/lessons'); 
            } 
            else 
            {
                $schedule = $teacher->getScheduleAsTeacher($user_teacher); 
            } 
        } 
        // If student, check if this teacher is yours then show schedule 
        if($student)  { 
            $myteachers = $student->teachers()->get(); 

            if(!$myteachers->contains($teacher->id)){ 
                Session::flash('flash_message', 'You are not '.$teacher->user->first_name."'s student.");
                return redirect('/lessons');
            } 

            $schedule = $teacher->getScheduleAsStudent($student);  

        } 

        return view('teacher.show')->with([
            'schedule'=>$schedule,
            'teacher_user'=>$teacher->user
        ]);
        dump("end");
        // shouldn't get here. Neither teacher nor student! 
    } 
}
