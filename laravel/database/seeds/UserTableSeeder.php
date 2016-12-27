<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User([
            'password' => '$2y$10$urPqqmMYwHD0HMPfydITmuKlIe6tsXHYR8UjYwyAk2oHSXkyrH7f6',
            'status' => '1',
            'type_of_user_id' => '1',
            'email' => 'frank@flyalas.com',
            'person_id' => '1'
        ]);

        $user->save();

        $user = new \App\User([
            'password' => '$2y$10$urPqqmMYwHD0HMPfydITmuKlIe6tsXHYR8UjYwyAk2oHSXkyrH7f6',
            'status' => '1',
            'type_of_user_id' => '2',
            'email' => 'johnSmith@gmail.com',
            'person_id' => '2'
        ]);

        $user->save();

        $user = new \App\User([
            'password' => '$2y$10$urPqqmMYwHD0HMPfydITmuKlIe6tsXHYR8UjYwyAk2oHSXkyrH7f6',
            'status' => '1',
            'type_of_user_id' => '3',
            'email' => 'magua@gmail.com',
            'person_id' => '3'
        ]);

        $user->save();
    }
}
