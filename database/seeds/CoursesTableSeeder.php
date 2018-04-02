<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            [
                'name' => 'Computer Architecture',
                'course_code' => 'CSM 300'
            ],
            [
                'name' => 'Computer Graphics',
                'course_code' => 'CSM 301'
            ],
            [
                'name' => 'Data Structures and Algorithms',
                'course_code' => 'CSM 302'
            ],
            [
                'name' => 'Embedded Systems',
                'course_code' => 'CSM 304'
            ],
            [
                'name' => 'Computer Networks',
                'course_code' => 'CSM 400'
            ],
            [
                'name' => 'Computer Security',
                'course_code' => 'CSM 401'
            ],
            [
                'name' => 'Information Systems',
                'course_code' => 'CSM 402'
            ],
            [
                'name' => 'Expert Systems',
                'course_code' => 'CSM 403'
            ]
        ]);
    }
}
