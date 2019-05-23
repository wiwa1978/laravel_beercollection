<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Traits\HasRoles;

class UsersTableSeederWithRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Wim Wauters',
            'email' => 'wauters1978@gmail.com',
            'password' => bcrypt('12345678a-'),
            'email_verified_at' => now(),
            'remember_token'    => str_random(10),
            'created_at'        => now(),
            'updated_at'        => now()
        ]);

        //$admin->attachRole('admin');

        $user1 = User::create([
            'name' => 'Kurt Van der Voorde',
            'email' => 'kurt@gmail.com',
            'password' => bcrypt('12345678a-'),
            'email_verified_at' => now(),
            'remember_token'    => str_random(10),
            'created_at'        => now(),
            'updated_at'        => now()
        ]);

        //$user1->attachRole('collector');

        $user2 = User::create([
            'name' => 'Iris Van der Voorde',
            'email' => 'iris@gmail.com',
            'password' => bcrypt('12345678a-'),
            'email_verified_at' => now(),
            'remember_token'    => str_random(10),
            'created_at'        => now(),
            'updated_at'        => now()
        ]);

        //$user2->attachRole('collector');


    }
}