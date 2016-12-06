<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(TeachersTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
        $this->call(LessonsTableSeeder::class);
        $this->call(LessonTeacherTableSeeder::class); 
//        $this->call(TagsTableSeeder::class);
//        $this->call(AuthorsTableSeeder::class);
//        $this->call(BooksTableSeeder::class);
//        $this->call(BookTagTableSeeder::class);
    }
}