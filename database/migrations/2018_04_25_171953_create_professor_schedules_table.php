<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessorSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professor_schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('timetable_id')->unsigned();
            $table->integer('day_id')->unsigned();
            $table->integer('timeslot_id')->unsigned();
            $table->integer('professor_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->integer('class_id')->unsigned();
            $table->integer('room_id')->unsigned();
            $table->timestamps();

            $table->foreign('timetable_id')
                ->references('id')
                ->on('timetables')
                ->onDelete('cascade');

            $table->foreign('day_id')
                ->references('id')
                ->on('days')
                ->onDelete('cascade');

            $table->foreign('timeslot_id')
                ->references('id')
                ->on('timeslots')
                ->onDelete('cascade');

            $table->foreign('professor_id')
                ->references('id')
                ->on('professors')
                ->onDelete('cascade');

            $table->foreign('course_id')
                ->references('id')
                ->on('courses')
                ->onDelete('cascade');

            $table->foreign('class_id')
                ->references('id')
                ->on('classes')
                ->onDelete('cascade');

            $table->foreign('room_id')
                ->references('id')
                ->on('rooms')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professor_schedules');
    }
}
