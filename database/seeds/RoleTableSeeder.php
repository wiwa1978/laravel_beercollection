<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
           'Admin',
           'Collector',
        ];


        foreach ($roles as $role) {
             Role::create([
                'name' => $role,
                'guard_name'    => 'web',
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }
    }
}
