<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Session;
use App\Teacher;
use App\Student;
use App\Lesson;


class LessonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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

    /** 
    * POST
    */
    public function store(Request $request)
    { 
        dump("You found the store endpoint for new lesson");
        // Validate 
        $this->validate($request, [
            'start_time' => 'required', 
            'end_time' => 'required', 
        ]); 

        // Create a new Lesson
        $lesson = new Lesson(); 
        // Assign all attributes of the lesson from the form elements 
        $start_time = $request->input('start_time');
        $end_time = $request->input('end_time');
        $lesson->start_time = $start_time; 
        $lesson->end_time = $end_time; 
        $lesson->duration = (int)((strtotime($end_time)-strtotime($start_time))/60); 
        // Save the Lesson 
        $lesson->save(); 

        // Save associated teacher for lesson 
        $user = Auth::user(); 
        $teacher = $user->teacher()->get();
        $lesson->teachers()->sync($teacher); 
        $lesson->save(); 

        // Save associated Students for lesson 
        $students = ($request->students) ?: []; 
        $lesson->students()->sync($students); 
        $lesson->save(); 
    } 


    /**
    * GET 
    */ 
    public function create()
    {
        dump("You found the create endpoint for a new lesson ");
        $user = Auth::user(); 
        
        // Are you a teacher? If not, redirect with flash message 
        $teacher = $user->teacher()->first();
        
        if(!($teacher)) 
        { 
            return view('help')->with([
                'message' => 'Sorry, you need to be a teacher to create lessons',
            ]);
        } 

        // If you ARE a teacher, create a lesson with [or without ] a student. 
        // Get teacher's students
        $students = $teacher->students()->get(); 
        $students_for_dropdown = []; 
        foreach($students as $student)
        { 
            $students_for_dropdown[$student->id] = $student->user()->pluck('first_name')[0]; 
        } 
        // return student list to the view
        return view('lesson.create')->with([
            'students_for_dropdown' => $students_for_dropdown,
        ]); 
    } 

    /**
    * GET
    * Page to confirm deletion
    */
    public function delete($id) {
        dump("You found the delete endpoint for lesson id ".$id);
        //$book = Book::find($id);

        //return view('book.delete')->with('book', $book);
    }

    /**
    * POST / DELETE 
    * Process form to actually destroy  
    */
    public function destroy($id) {
        dump(" Endpoint to actually delete lesson id ".$id);
        //$book = Book::find($id);

        //return view('book.delete')->with('book', $book);
    }

        
    /**
    * GET
    */
    public function show($id) 
    {
        dump("You found the show endpoint for lesson id ".$id);
        //$book = Book::find($id);

        //return view('book.delete')->with('book', $book);
    }

    
    /**
    * POST / PUT 
    * Process form to edit 
    */
    public function update($id) {
        dump("You found the delete endpoint for lesson id ".$id);
        //$book = Book::find($id);

        //return view('book.delete')->with('book', $book);
    }
    /**
    * GET
    * Show form to edit 
    */
    public function edit($id) {
        dump("You found the delete endpoint for lesson id ".$id);
        //$book = Book::find($id);

        //return view('book.delete')->with('book', $book);
    }


}
