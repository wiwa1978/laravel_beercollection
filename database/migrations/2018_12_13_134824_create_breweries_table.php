<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBreweriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breweries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign( 'user_id' )
                ->references( 'id' )->on( 'users' )
                ->onUpdate( 'cascade' );
            $table->string('brewery_name');
            $table->string('brewery_description')->nullable();
            $table->integer('brewery_zipcode');
            $table->string('brewery_city');
            $table->string('brewery_subcity')->nullable();
            $table->string('brewery_state')->nullable();
            $table->string('brewery_country');
            $table->text('brewery_history')->nullable();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('breweries');
    }
}
