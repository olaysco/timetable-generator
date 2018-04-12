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
                'course_code' => 'CSM 301'
            ],
            [
                'name' => 'Computer Graphics',
                'course_code' => 'CSM 302'
            ],
            [
                'name' => 'Data Structures and Algorithms I',
                'course_code' => 'CSM 303'
            ],
            [
                'name' => 'Survey Of Programming Languages',
                'course_code' => 'CSM 304'
            ],
            [
                'name' => 'System Analysis',
                'course_code' => 'CSM 305'
            ],
            [
                'name' => 'Artificial Intelligence',
                'course_code' => 'CSM 306'
            ],
            [
                'name' => 'Operations Research I',
                'course_code' => 'CSM 307'
            ],
            [
                'name' => 'Web Development',
                'course_code' => 'CSM 308'
            ],
            [
                'name' => 'Data Structures And Algorithms II',
                'course_code' => 'CSM 311'
            ],
            [
                'name' => 'Operations Research II',
                'course_code' => 'CSM 312'
            ],
            [
                'name' => 'Real time and Embedded Systems',
                'course_code' => 'CSM 313'
            ],
            [
                'name' => 'Ecommerce',
                'course_code' => 'CSM 314'
            ],
            [
                'name' => 'Accounting',
                'course_code' => 'CSM 315'
            ],
            [
                'name' => 'Computer Networks',
                'course_code' => 'CSM 401'
            ],
            [
                'name' => 'Computer Security',
                'course_code' => 'CSM 402'
            ],
            [
                'name' => 'Information Systems',
                'course_code' => 'CSM 403'
            ],
            [
                'name' => 'Expert Systems',
                'course_code' => 'CSM 404'
            ],
            [
                'name' => 'Computer Vision',
                'course_code' => 'CSM 405'
            ],
            [
                'name' => 'Software Engineering I',
                'course_code' => 'CSM 406'
            ],
            [
                'name' => 'Cyber Security',
                'course_code' => 'CSM 407'
            ],
            [
                'name' => 'Robotics',
                'course_code' => 'CSM 411'
            ],
            [
                'name' => 'Graph Theory',
                'course_code' => 'CSM 412'
            ],
            [
                'name' => 'Number Theory',
                'course_code' => 'CSM 413'
            ],
            [
                'name' => 'French',
                'course_code' => 'CSM 414'
            ],
            [
                'name' => 'Software Engineering II',
                'course_code' => 'CSM 415'
            ]
        ]);
    }
}
