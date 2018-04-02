<?php

use Illuminate\Database\Seeder;

class TimeslotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('timeslots')->insert([
            [
                'time' => '8:00 - 10:00',
                'rank' => 1
            ],
            [
                'time' => '10:00 - 12:00',
                'rank' => 2
            ],
            [
                'time' => '12:00 - 14:00',
                'rank' => 3
            ],
            [
                'time' => '14:00 - 16:00',
                'rank' => 4
            ]
        ]);
    }
}
