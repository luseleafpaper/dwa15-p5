<?php

use Illuminate\Database\Seeder;
use App\Lesson;

class LessonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a couple lessons 
        $lessons = [
            ['Lesson with Jamal and Jill', '2016-12-08 11:00', '2016-12-08 12:00', 60],
            ['Available lesson', '2016-12-08 12:00', '2016-12-08 13:00', 60],
            ['Lesson with Jamal', '2016-12-09 11:00', '2016-12-09 12:00', 60],
        ];
        
        foreach($lessons as $lesson) { 
            Lesson::create([
                'title' =>$lesson[0], 
                'start_time' => $lesson[1], 
                'end_time' => $lesson[2], 
                'duration' => (int)((strtotime($lesson[2])-strtotime($lesson[1]))/60),  
            ]); 
        } 
    }
}
