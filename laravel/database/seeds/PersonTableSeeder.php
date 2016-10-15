<?php

use Illuminate\Database\Seeder;

class PersonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*1 Admin*/
        $person = new \App\Person([
            'first_name' => 'Frank',
            'last_name' => 'A Requena',
            'date_of_birth' => '1960-05-04',
            'gender' => 'male',
            'city_country_of_birth' => 'Republica Dominicana']);
        $person->save();

        /*2 Student*/
        $person = new \App\Person([
            'first_name' => 'John',
            'last_name' => 'Smith',
            'date_of_birth' => '1990-09-21',
            'gender' => 'male',
            'city_country_of_birth' => 'Tijuana, Mexico']);
        $person->save();

        /*3 Instructor*/
        $person = new \App\Person([
            'first_name' => 'Maria',
            'last_name' => 'Guadalupe',
            'date_of_birth' => '1970-02-19',
            'gender' => 'female',
            'city_country_of_birth' => 'Guadalajara, Mexico']);
        $person->save();

        $person = new \App\Person([
            'first_name' => 'Robert',
            'last_name' => 'Jackson',
            'date_of_birth' => '1960-12-12',
            'gender' => 'male',
            'city_country_of_birth' => 'England']);
        $person->save();
    }
}
