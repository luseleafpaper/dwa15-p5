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
            ['2016-12-08 11:00:00', '2016-12-08 12:00:00', 60],
            ['2016-12-08 12:00:00', '2016-12-08 13:00:00', 60],
            ['2016-12-09 11:00:00', '2016-12-09 12:00:00', 60],
        ];
        
        foreach($lessons as $lesson) { 
            Lesson::create([
                'start_time' => $lesson[0], 
                'end_time' => $lesson[1], 
                'duration' => (int)((strtotime($lesson[1])-strtotime($lesson[0]))/60),  
            ]); 
        } 
    }
}
