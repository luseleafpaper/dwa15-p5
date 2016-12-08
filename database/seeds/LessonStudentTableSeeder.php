<?php

use Illuminate\Database\Seeder;
use app\Student;
use app\Lesson;

class LessonStudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $studentLessons = [
            // Lu is teacher lessons 1 and 2, Jill is teacher lessons 1 and 3
            '1' => ['1'], // Jill will attend Lu's lessons
            '2' => ['1', '2', '3'], // Jamal will attend Lu's lessons
        ];

        foreach($studentLessons as $studentId=> $lessonIds) {
            foreach($lessonIds as $lessonId) {
                $student = Student::where('id', 'like', $studentId)->first();
                $lesson = Lesson::where('id', 'like', $lessonId)->first();

                $student->lessons()->save($lesson);
            }
        }

    }
}
