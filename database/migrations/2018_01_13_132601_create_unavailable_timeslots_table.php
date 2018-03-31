<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnavailableTimeslotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unavailable_timeslots', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('professor_id')->unsigned();
            $table->integer('timeslot_id')->unsigned();
            $table->integer('day_id')->unsigned();
            $table->timestamps();

            $table->foreign('professor_id')
                ->references('id')
                ->on('professors')
                ->onDelete('cascade');

            $table->foreign('timeslot_id')
                ->references('id')
                ->on('timeslots')
                ->onDelete('cascade');

            $table->foreign('day_id')
                ->references('id')
                ->on('days')
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
        Schema::dropIfExists('unavailable_timeslots');
    }
}
