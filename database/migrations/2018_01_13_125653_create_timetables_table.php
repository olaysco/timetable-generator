<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimetablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timetables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('status', ['IN PROGRESS', 'COMPLETED']);
            $table->string('file_url')->nullable();
            $table->text('chromosome')->nullable();
            $table->text('scheme')->nullable();
            //$table->decimal('mutation_rate', 5, 4);
            //$table->decimal('crossover_rate', 5, 4);
            //$table->integer('population_count')->unsigned();
            $table->decimal('fitness', 8, 6)->nullable();
            $table->integer('generations')->unsigned()->nullable();
            $table->integer('violated_constraints')->unsigned()->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('academic_period_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('academic_period_id')
                ->references('id')
                ->on('academic_periods')
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
        Schema::dropIfExists('timetables');
    }
}
