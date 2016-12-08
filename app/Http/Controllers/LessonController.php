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
    public function store()
    { 
        dump("You found the store endpoint for lesson id ".$id);
        // Validate 

        // Create a new Lesson
        // Assign all attributes of the lesson from the form elements 
        // Save the Lesson 
        // Get associated Students for lesson 
        // Save all associated Students 
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

        if($teacher) {
            // If you ARE a teacher, create a lesson with [or without ] a student. 
            // With student means the student will see this lesson 
            // Without means the lesson is an available block time 
            $students_for_dropdown = ['Jill', 'Lu', 'Jamal'];
            return view('lesson.create')->with([
                'students_for_dropdown' => $students_for_dropdown,
            ]); 
        } 
        else
        { 
            return view('help')->with([
                'message' => 'You need to be a teacher to create lessons',
            ]); 
        } 
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
