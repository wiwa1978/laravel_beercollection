<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'id'                    => 1,
            'user_id'               => 2,
            'category_name'         => "Category 1 - Iris",
            'category_description'  => "Category 1 - Iris",
            'created_at'            => now(),
            'updated_at'            => now()
        ]);

        DB::table('categories')->insert([
            'id'                    => 2,
            'user_id'               => 2,
            'category_name'         => "Category 2 - Iris",
            'category_description'  => "Category 2 - Iris",
            'created_at'            => now(),
            'updated_at'            => now()
        ]);

        /*
        DB::table('categories')->insert([
            'id'                    => 3,
            'user_id'               => 3,
            'category_name'         => "Category 1 - Kurt",
            'category_description'  => "Category 1 - Kurt",
            'created_at'            => now(),
            'updated_at'            => now()
        ]);

        DB::table('categories')->insert([
            'id'                    => 4,
            'user_id'               => 3,
            'category_name'         => "Category 2 - Kurt",
            'category_description'  => "Category 2 - Kurt",
            'created_at'            => now(),
            'updated_at'            => now()
        ]);
        */
       
    }
}
