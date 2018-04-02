<?php

use Illuminate\Database\Seeder;

class ProfessorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('professors')->insert([
            [
                'name' => 'Dr Theophilus Asare'
            ],
            [
                'name' => 'Dr Richman Clifford'
            ],
            [
                'name' => 'Dr Ahmed Dawuda'
            ],
            [
                'name' => 'Dr Jehoshaphat Koney'
            ],
            [
                'name' => 'Dr Godfred Addai'
            ],
            [
                'name' => 'Dr Gideon Appoh'
            ]
        ]);

        DB::table('courses_professors')->insert([
            [
                'course_id' => 1,
                'professor_id' => 1
            ],
            [
                'course_id' => 5,
                'professor_id' => 1
            ],
            [
                'course_id' => 3,
                'professor_id' => 2
            ],
            [
                'course_id' => 8,
                'professor_id' => 2
            ],
            [
                'course_id' => 5,
                'professor_id' => 4
            ],
            [
                'course_id' => 4,
                'professor_id' => 3
            ],
            [
                'course_id' => 7,
                'professor_id' => 6
            ],
            [
                'course_id' => 4,
                'professor_id' => 5
            ]
        ]);

        DB::table('unavailable_timeslots')->insert([
            [
                'professor_id' => 2,
                'day_id' => 1,
                'timeslot_id' => 1
            ],
            [
                'professor_id' => 6,
                'day_id' => 4,
                'timeslot_id' => 2
            ]
        ]);
    }
}
