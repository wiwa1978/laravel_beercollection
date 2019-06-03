<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissions = [
           'manage-beerglasses',
           'manage-beerlabels',
           'manage-beercoasters',
           'manage-beerashtrays',
           'manage-beercontainers',
           'manage-beerbottles',
           'manage-beerplateaus',
           'manage-beeradvertisements',
           'manage-beerstonejugs'
        ];


        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }

    }
}


