<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentIndividualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_individuals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('dob');
            $table->string('city', 100);
            $table->string('major', 100);
            $table->string('faculty', 100);
            $table->string('university', 100);
            $table->string('picture', 25)->nullable();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_individuals');
    }
}
