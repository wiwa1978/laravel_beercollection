<?php

use Illuminate\Database\Seeder;

class TicketTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ticket_types')->insert([
            'id'                    => 1,
            'type_name'             => "Defect",
            'created_at'            => now(),
            'updated_at'            => now()
        ]);

         DB::table('ticket_types')->insert([
            'id'                    => 2,
            'type_name'             => "Features",
            'created_at'            => now(),
            'updated_at'            => now()
        ]);



    }
}
