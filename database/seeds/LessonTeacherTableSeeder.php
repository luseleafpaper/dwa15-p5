<?php

use Illuminate\Database\Seeder;
use App\Teacher;
use App\Lesson;

class LessonTeacherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $teacherLessons = [
            '1' => ['1', '2'],
            '2' => ['3', '1'], 
        ]; 

        foreach($teacherLessons as $teacherId=> $lessonIds) { 
            foreach($lessonIds as $lessonId) { 
                $teacher = Teacher::where('id', 'like', $teacherId)->first(); 
                $lesson = Lesson::where('id', 'like', $lessonId)->first(); 
                
                $teacher->lessons()->save($lesson); 
            } 
        } 

    }
}
