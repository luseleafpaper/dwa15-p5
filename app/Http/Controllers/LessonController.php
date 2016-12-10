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
        $teacher = $user->teacher()->first();

        if($teacher) { 
            $teacher_lessons = $teacher->lessons()->with('students')->orderBy('start_time')->get(); 
        } else { 
            $teacher_lessons = []; 
        }     
        
        $student = $user->student()->first();
        
        if($student) {
            $student_lessons = $student->lessons()->get(); 
        } else { 
            $student_lessons = []; 
        }     
        
        return view('lesson.index')->with([
            'teacher_lessons'=>$teacher_lessons,
            'student_lessons'=>$student_lessons,
            'user_name'=> $user->first_name.' '.$user->last_name, 
            'user'=> $user, 

        ]); 
    } 

    /** 
    * POST
    */
    public function store(Request $request)
    { 
        // Validate 
        $this->validate($request, [
            'start_time' => 'required', 
            'title' => 'required',
            'end_time' => 'required', 
        ]); 

        // Create a new Lesson
        $lesson = new Lesson(); 

        // Assign all attributes of the lesson from the form elements 
        $lesson->title = $request->input('title'); 
        $lesson->start_time = $request->input('start_time');
        $lesson->end_time = $request->input('end_time');
        $lesson->duration = (int)((strtotime($lesson->end_time)-strtotime($lesson->start_time))/60); 
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

        // Save associated teachers for lesson 
        $teachers = ($request->teachers) ?: []; 
        $lesson->teachers()->sync($teachers); 
        $lesson->save(); 

        # Finish
        Session::flash('flash_message', 'You created a lesson.');
        return redirect('/lessons');
    } 


    /**
    * GET 
    */ 
    public function create()
    {
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
        $students_for_checkboxes = []; 
        foreach($students as $student)
        { 
            $students_for_checkboxes[$student->id] = $student->user()->pluck('first_name')[0]; 
        } 
        // return student list to the view

        $teachers_for_checkboxes = $teacher->teachersForCheckboxes();
        return view('lesson.create')->with([
            'user'=>$user,  
            'teacher'=>$teacher,
            'students_for_checkboxes' => $students_for_checkboxes,
            'teachers_for_checkboxes' => $teachers_for_checkboxes,
        ]); 
    } 

    /**
    * GET
    * Page to confirm deletion
    */
    public function delete($id) {
        $lesson = Lesson::find($id);

        return view('lesson.delete')->with('lesson', $lesson);
    }

    /**
    * POST / DELETE 
    * Process form to actually destroy  
    */
    public function destroy($id) {
        # Get the lesson to be deleted
        $lesson = Lesson::find($id);

        if(is_null($lesson)) {
            Session::flash('message','Lesson not found.');
            return redirect('/lessons');
        }

        # First remove any tags associated with this lesson
        if($lesson->students()) {
            $lesson->students()->detach();
        }

        # First remove any tags associated with this lesson
        if($lesson->teachers()) {
            $lesson->teachers()->detach();
        }

        # Then delete the lesson
        $lesson->delete();

        # Finish
        Session::flash('flash_message', 'Lesson starting at '.$lesson->start_time.' was deleted.');
        return redirect('/lessons');
    }

        
    /**
    * GET
    */
    public function show($id) 
    {
        $user = Auth::user();
        $teacher = $user->teacher()->first(); 
        $lessons = $teacher->lessons()->get(); 
        $lesson = Lesson::find($id);
        
        if(!$lesson) { 
            return view('help')->with([
                'message' => 'Sorry, lesson id '.$id." doesn't exist",
            ]);
        } 
        if(!$lessons->contains($lesson)) { 
            return view('help')->with([
                'message' => 'Sorry, you must be a teacher for lesson '.$id.' to view its details',
            ]);
        } 

        if(is_null($lesson)) {
            Session::flash('message','Lesson not found');
            return redirect('/lessons');
        }
        
        $students = $lesson->students()->get(); 
        $student_names = []; 
        foreach($students as $student) {  
            $first = $student->user()->pluck('first_name')[0];  
            $last = $student->user()->pluck('last_name')[0];  
            $student_names[] = $first.' '.$last; 
        } 

        $teachers = $lesson->teachers()->get();
        $teacher_names = []; 
        foreach($teachers as $teacher) { 
            $first = $teacher->user()->pluck('first_name')[0];
            $last = $teacher->user()->pluck('last_name')[0];
            $teacher_names[] = $first.' '.$last;
        }

        return view('lesson.show')->with([
            'lesson' => $lesson,
            'students' => $student_names, 
            'teachers' => $teacher_names, 
        ]);
    }

    
    /**
    * POST / PUT 
    * Process form to edit 
    */
    public function update(Request $request, $id) {
        // Validate 
        $this->validate($request, [
            'start_time' => 'required',
            'end_time' => 'required',
            'title' => 'required',
            'teachers'=>'required|array|between:0,10', 
        ]);

        // Find 
        $lesson = Lesson::find($id);
        //$lesson = Lesson::find($request->id);
        // Assign all attributes of the lesson from the form elements 
        $start_time = $request->input('start_time');
        $end_time = $request->input('end_time');
        $lesson->title = $request->input('title');
        $lesson->start_time = $start_time;
        $lesson->end_time = $end_time;
        $lesson->duration = (int)((strtotime($end_time)-strtotime($start_time))/60);
        // Save the Lesson 
        $lesson->save();

        // Save associated Students for lesson 
        $students = ($request->students) ?: [];
        $lesson->students()->sync($students);
        $lesson->save();

        // Save associated teachers for lesson 
        $teachers = ($request->teachers) ?: []; 
        $lesson->teachers()->sync($teachers); 
        $lesson->save(); 

        # Finish
        Session::flash('flash_message', 'You edited a lesson.');
        return redirect('/lessons/'.$id);

    }
    /**
    * GET
    * Show form to edit 
    */
    public function edit($id) {
        $user = Auth::user();
        $teacher = $user->teacher()->first();
        $lessons = $teacher->lessons()->get();
        $lesson = Lesson::find($id);

        if(!$lesson) {
            return view('help')->with([
                'message' => 'Sorry, lesson id '.$id." doesn't exist",
            ]);
        }
        if(!$lessons->contains($lesson)) {
            return view('help')->with([
                'message' => 'Sorry, you do not have access to lesson id '.$id,
            ]);
        }

        $students = $teacher->students()->get();
        $students_for_checkboxes = [];
        foreach($students as $student)
        {
            $students_for_checkboxes[$student->id] = $student->user()->pluck('first_name')[0];
        }

        $students_for_this_lesson = []; 
        $lesson_students = $lesson->students()->get(); 
        foreach($lesson_students as $lesson_student){ 
            $students_for_this_lesson[]=$lesson_student->user()->pluck('first_name')[0]; 
        } 

        $teachers_for_checkboxes = $teacher->teachersForCheckboxes(); 
        $teachers_for_this_lesson = $lesson->teacherIDsForThisLesson(); 

        return view('lesson.edit')->with([
            'lesson'=>$lesson,
            'students_for_this_lesson'=>$students_for_this_lesson, 
            'students_for_checkboxes'=>$students_for_checkboxes,
            'teachers_for_this_lesson'=>$teachers_for_this_lesson, 
            'teachers_for_checkboxes'=>$teachers_for_checkboxes,
        ]); 
    }
}
