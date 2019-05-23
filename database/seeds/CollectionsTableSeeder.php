<?php

use Illuminate\Database\Seeder;

class CollectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('collections')->insert([
            'id'                    => 1,
            'user_id'               => 2,
            'collection_name'       => 'Collection Iris - Beerglasses',
            'collection_description'=> 'Collection Iris description',
            'collection_type'       => 'beerglasses',
            'created_at'            => now(),
            'updated_at'            => now()
        ]);

        DB::table('collections')->insert([
            'id'                    => 2,
            'user_id'               => 2,
            'collection_name'       => 'Collection Iris - Beerashtrays',
            'collection_description'=> 'Collection Iris description',
            'collection_type'       => 'beerashtrays',
            'created_at'            => now(),
            'updated_at'            => now()
        ]);

        DB::table('collections')->insert([
            'id'                    => 3,
            'user_id'               => 2,
            'collection_name'       => 'Collection Iris - Beercontainers',
            'collection_description'=> 'Collection Iris description',
            'collection_type'       => 'beercontainers',
            'created_at'            => now(),
            'updated_at'            => now()
        ]);

        DB::table('collections')->insert([
            'id'                    => 4,
            'user_id'               => 2,
            'collection_name'       => 'Collection Iris - Beerlabels',
            'collection_description'=> 'Collection Iris description',
            'collection_type'       => 'beerlabels',
            'created_at'            => now(),
            'updated_at'            => now()
        ]);

        DB::table('collections')->insert([
            'id'                    => 5,
            'user_id'               => 2,
            'collection_name'       => 'Collection Iris - Beerbottles',
            'collection_description'=> 'Collection Iris description',
            'collection_type'       => 'beerbottles',
            'created_at'            => now(),
            'updated_at'            => now()
        ]);

        DB::table('collections')->insert([
            'id'                    => 6,
            'user_id'               => 2,
            'collection_name'       => 'Collection Iris - Beerplateaus',
            'collection_description'=> 'Collection Iris description',
            'collection_type'       => 'beerplateaus',
            'created_at'            => now(),
            'updated_at'            => now()
        ]);

        DB::table('collections')->insert([
            'id'                    => 7,
            'user_id'               => 2,
            'collection_name'       => 'Collection Iris - Beeradvertisements',
            'collection_description'=> 'Collection Iris description',
            'collection_type'       => 'beeradvertisements',
            'created_at'            => now(),
            'updated_at'            => now()
        ]);

        DB::table('collections')->insert([
            'id'                    => 8,
            'user_id'               => 2,
            'collection_name'       => 'Collection Iris - Beercoasters',
            'collection_description'=> 'Collection Iris description',
            'collection_type'       => 'beercoasters',
            'created_at'            => now(),
            'updated_at'            => now()
        ]);

        DB::table('collections')->insert([
            'id'                    => 9,
            'user_id'               => 2,
            'collection_name'       => 'Collection Iris - Beerstonejugs',
            'collection_description'=> 'Collection Iris description',
            'collection_type'       => 'beerstonejugs',
            'created_at'            => now(),
            'updated_at'            => now()
        ]);


    }
}
