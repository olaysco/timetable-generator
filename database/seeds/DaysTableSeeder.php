<?php

use Illuminate\Database\Seeder;

class DaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = [
            [
                'name' => 'Monday',
                'short_name' => 'Mon'
            ],
            [
                'name' => 'Tuesday',
                'short_name' => 'Tue'
            ],
            [
                'name' => 'Wednesday',
                'short_name' => 'Wed'
            ],
            [
                'name' => 'Thursday',
                'short_name' => 'Thur'
            ],
            [
                'name' => 'Friday',
                'short_name' => 'Fri'
            ],
            [
                'name' => 'Saturday',
                'short_name' => 'Sat'
            ],
            [
                'name' => 'Sunday',
                'short_name' => 'Sun'
            ]
        ];

        foreach ($days as $day) {
            $existing = DB::table('days')->where('name', $day['name'])->first();

            if (!$existing) {
                DB::table('days')->insert($day);
            }
        }
    }
}
