<?php

use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert([
            [
                'name' => 'SF 19',
                'capacity' => 120
            ],
            [
                'name' => 'SF 20',
                'capacity' => 120
            ],
            [
                'name' => 'FF 1',
                'capacity' => 200
            ],
            [
                'name' => 'SF 1',
                'capacity' => 200
            ],
            [
                'name' => 'SF 8',
                'capacity' => 150
            ]
        ]);
    }
}
