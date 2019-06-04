<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountryRegionCityTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('country_name');
            $table->timestamps();
        });
        Schema::create('regions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('region_name');
            $table->integer('country_id');
            $table->timestamps();
        });
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('city_name');
            $table->integer('region_id');
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
        Schema::dropIfExists('countries');
        Schema::dropIfExists('regions');
        Schema::dropIfExists('cities');
    }
}
