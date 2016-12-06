<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_teacher', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            # Make columns that will become foreigh keys 
            $table->integer('lesson_id')->unsigned();
            $table->integer('teacher_id')->unsigned();
            # Make foreign keys
            $table->foreign('lesson_id')->references('id')->on('lessons');
            $table->foreign('teacher_id')->references('id')->on('teachers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lesson_teacher');
    }

}
