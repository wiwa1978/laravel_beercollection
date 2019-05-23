<?php

use Illuminate\Database\Seeder;

class BreweryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('breweries')->insert([
            'id'                    => 1,
            'user_id'               => 2,
            'brewery_name'          => 'Bosteels',
            'brewery_description'   => 'Bosteels description',
            'brewery_zipcode'       => 9255,
            'brewery_town'          => 'Buggenhout',
            'brewery_subtown'       => 'Opstal',
            'brewery_province'      => 'Oost-Vlaanderen',
            'brewery_country'       => 'België',
            'created_at'            => now(),
            'updated_at'            => now()
        ]);



        DB::table('breweries')->insert([
            'id'                    => 2,
            'user_id'               => 2,
            'brewery_name'          => 'VanderGhinste',
            'brewery_description'   => 'VanderGhinste description',
            'brewery_zipcode'       => 8500,
            'brewery_town'          => 'Kortrijk',
            'brewery_subtown'       => 'Vichte',
            'brewery_province'      => 'West-Vlaanderen',
            'brewery_country'       => 'België',
            'created_at'            => now(),
            'updated_at'            => now()
        ]);

        /*
        DB::table('breweries')->insert([
            'id'                    => 3,
            'user_id'               => 3,
            'brewery_name'          => 'Palm Breweries',
            'created_at'            => now(),
            'updated_at'            => now()
        ]);

         DB::table('breweries')->insert([
            'id'                    => 4,
            'user_id'               => 3,
            'brewery_name'          => 'Inbev',
            'created_at'            => now(),
            'updated_at'            => now()
        ]);
        */
    }
}
