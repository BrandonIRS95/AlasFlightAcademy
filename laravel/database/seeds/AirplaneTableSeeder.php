<?php

use Illuminate\Database\Seeder;

class AirplaneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $airplane = new \App\Airplane([
            'plate' => 'A-SD45A-4',
            'name' => 'The bird',
            'photo' => '1.png',
            'status' => 'active'
        ]);
        $airplane->save();
    }
}
