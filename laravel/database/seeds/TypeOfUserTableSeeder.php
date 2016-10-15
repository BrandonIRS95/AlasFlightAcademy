<?php

use Illuminate\Database\Seeder;

class TypeOfUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = new \App\TypeOfUser([
           'type' => 'Admin'
        ]);

        $type->save();

        $type = new \App\TypeOfUser([
            'type' => 'Student'
        ]);

        $type->save();

        $type = new \App\TypeOfUser([
            'type' => 'Instructor'
        ]);

        $type->save();
    }
}
