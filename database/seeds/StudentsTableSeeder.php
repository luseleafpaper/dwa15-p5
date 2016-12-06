<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Student;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $studentEmails = ['jamal@harvard.edu', 'jill@harvard.edu']; 
        
        $existingStudents = Student::all()->keyBy('user_id')->toArray(); 
        
        foreach($studentEmails as $email) { 

            $user_id = User::where('email','=',$email)->pluck('id')->first();

            if(!array_key_exists($user_id, $existingStudents)) { 

                DB::table('students')->insert([
                    'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'user_id' => $user_id,
                ]);
            } 
        } 
    }
}
