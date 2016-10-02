<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PersonTableSeeder::class);
        $this->call(PilotProgramTableSeeder::class);
        $this->call(TypeOfUserTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(InstructorTableSeeder::class);
    }
}
