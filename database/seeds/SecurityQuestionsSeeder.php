<?php

use Illuminate\Database\Seeder;

class SecurityQuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('security_questions')
            ->insert([
                ["question" => "In which city were you born?"],
                ["question" => "In which town was your dad born?"],
                ["question" => "In which town was your mum born?"],
                ["question" => "What's the name of your favourite cousin?"],
                ["question" => "What's the name of your primary school?"],
                ["question" => "What's the last name of your best childhood friend?"]
            ]);
    }
}
