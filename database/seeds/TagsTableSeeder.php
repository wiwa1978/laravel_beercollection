<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            'user_id'               => 2,
            'tag_name'              => "Tag 1 - Iris",
            'created_at'            => now(),
            'updated_at'            => now()
        ]);

        DB::table('tags')->insert([
            'user_id'               => 2,
            'tag_name'              => "Tag 2 - Iris",
            'created_at'            => now(),
            'updated_at'            => now()
        ]);

        /*
        DB::table('tags')->insert([
            'user_id'               => 3,
            'tag_name'              => "Tag 1 - Kurt",
            'created_at'            => now(),
            'updated_at'            => now()
        ]);

        DB::table('tags')->insert([
            'user_id'               => 3,
            'tag_name'              => "Tag 2 - Kurt",
            'created_at'            => now(),
            'updated_at'            => now()
        ]);
        */
       
    }
}
