<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id'                => 1,
            'name'              => "Wim Wauters",
            'email'             => 'wauters1978@gmail.com',
            'email_verified_at' => now(),
            'password'          => bcrypt('12345678a-'),
            'remember_token'    => str_random(10),
            'created_at'        => now(),
            'updated_at'        => now()
        ]);

        DB::table('users')->insert([
            'id'                => 2,
            'name'              => "Iris Van der Voorde",
            'email'             => 'iris@gmail.com',
            'email_verified_at' => now(),
            'password'          => bcrypt('12345678a-'),
            'remember_token'    => str_random(10),
            'created_at'        => now(),
            'updated_at'        => now()
        ]);

        DB::table('users')->insert([
            'id'                => 3,
            'name'              => "Kurt Van der Voorde",
            'email'             => 'kurt@gmail.com',
            'email_verified_at' => now(),
            'password'          => bcrypt('12345678a-'),
            'remember_token'    => str_random(10),
            'created_at'        => now(),
            'updated_at'        => now()
        ]);
    }
}