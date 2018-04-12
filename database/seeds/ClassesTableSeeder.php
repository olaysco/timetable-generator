<?php

use Illuminate\Database\Seeder;

class ClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classes')->insert([
            [
                'name' => 'CS 3',
                'size' => 180
            ],
            [
                'name' => 'CS 4',
                'size' => 200
            ]
        ]);

        DB::table('courses_classes')->insert([
            [
                'course_id' => 1,
                'class_id' => 1,
                'meetings' => 1,
                'academic_period_id' => 1
            ],
            [
                'course_id' => 2,
                'class_id' => 1,
                'meetings' => 1,
                'academic_period_id' => 1

            ],
            [
                'course_id' => 3,
                'class_id' => 1,
                'meetings' => 2,
                'academic_period_id' => 1
            ],
            [
                'course_id' => 4,
                'class_id' => 1,
                'meetings' => 1,
                'academic_period_id' => 1
            ],
            [
                'course_id' => 5,
                'class_id' => 1,
                'meetings' => 1,
                'academic_period_id' => 1

            ],
            [
                'course_id' => 6,
                'class_id' => 1,
                'meetings' => 1,
                'academic_period_id' => 1
            ],
            [
                'course_id' => 7,
                'class_id' => 1,
                'meetings' => 2,
                'academic_period_id' => 1
            ],
            [
                'course_id' => 8,
                'class_id' => 1,
                'meetings' => 1,
                'academic_period_id' => 1
            ],
            [
                'course_id' => 9,
                'class_id' => 1,
                'meetings' => 2,
                'academic_period_id' => 2
            ],
            [
                'course_id' => 10,
                'class_id' => 1,
                'meetings' => 1,
                'academic_period_id' => 2
            ],
            [
                'course_id' => 11,
                'class_id' => 1,
                'meetings' => 1,
                'academic_period_id' => 2
            ],
            [
                'course_id' => 12,
                'class_id' => 1,
                'meetings' => 1,
                'academic_period_id' => 2
            ],
            [
                'course_id' => 13,
                'class_id' => 1,
                'meetings' => 1,
                'academic_period_id' => 2
            ],
            [
                'course_id' => 14,
                'class_id' => 2,
                'meetings' => 1,
                'academic_period_id' => 1
            ],
            [
                'course_id' => 15,
                'class_id' => 2,
                'meetings' => 1,
                'academic_period_id' => 1
            ],
            [
                'course_id' => 16,
                'class_id' => 2,
                'meetings' => 2,
                'academic_period_id' => 1
            ],
            [
                'course_id' => 17,
                'class_id' => 2,
                'meetings' => 2,
                'academic_period_id' => 1
            ],
            [
                'course_id' => 18,
                'class_id' => 2,
                'meetings' => 1,
                'academic_period_id' => 1
            ],
            [
                'course_id' => 19,
                'class_id' => 2,
                'meetings' => 1,
                'academic_period_id' => 2
            ],
            [
                'course_id' => 20,
                'class_id' => 2,
                'meetings' => 1,
                'academic_period_id' => 2
            ],
            [
                'course_id' => 21,
                'class_id' => 2,
                'meetings' => 1,
                'academic_period_id' => 2
            ],
            [
                'course_id' => 22,
                'class_id' => 2,
                'meetings' => 1,
                'academic_period_id' => 2
            ],
            [
                'course_id' => 23,
                'class_id' => 2,
                'meetings' => 1,
                'academic_period_id' => 2
            ]
        ]);
    }
}
