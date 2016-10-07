<?php

use Illuminate\Database\Seeder;

class InstructorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $instructor = new \App\Instructor([
            'person_id' => '3'
        ]);

        $instructor->save();

        $instructor = new \App\Instructor([
            'person_id' => '4'
        ]);

        $instructor->save();
    }
}
