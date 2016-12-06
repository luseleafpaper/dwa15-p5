<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Teacher;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teacherEmails = ['lu.wang@post.harvard.edu', 'jill@harvard.edu']; 
        
        $existingTeachers = Teacher::all()->keyBy('user_id')->toArray(); 
        
        foreach($teacherEmails as $email) { 

            $user_id = User::where('email','=',$email)->pluck('id')->first();

            if(!array_key_exists($user_id, $existingTeachers)) { 

                DB::table('teachers')->insert([
                    'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'user_id' => $user_id,
                ]);
            } 
        } 
    }
}
