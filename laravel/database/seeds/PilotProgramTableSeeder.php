<?php

use Illuminate\Database\Seeder;

class PilotProgramTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $program = new \App\PilotProgram([
           'name' => 'Basic',
            'price' => '125'
        ]);
        $program->save();

        $program = new \App\PilotProgram([
            'name' => 'Premium',
            'price' => '451'
        ]);
        $program->save();

        $program = new \App\PilotProgram([
            'name' => 'Military',
            'price' => '950'
        ]);
        $program->save();
    }
}
