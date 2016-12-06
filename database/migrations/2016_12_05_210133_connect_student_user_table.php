<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConnectStudentUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) { # Add a new INT field called user_id 
            $table->integer('user_id')->unsigned();
            # Connect this column to the id column on users table 
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            # ref: http://laravel.com/docs/5.1/migrations#dropping-indexes
            $table->dropForeign('students_user_id_foreign');
            $table->dropColumn('user_id');
        }); 
    }
}
