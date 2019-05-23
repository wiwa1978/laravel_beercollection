<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeerItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beeritems', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onUpdate( 'cascade' )
                    ->onDelete( 'cascade' );
             $table->unsignedInteger('collection_id');
            $table->foreign('collection_id')
                    ->references('id')->on('collections')
                    ->onUpdate( 'cascade' )
                    ->onDelete( 'cascade' );
            $table->unsignedInteger('brewery_id');
            $table->foreign( 'brewery_id' )
                ->references( 'id' )->on( 'breweries' )
                ->onUpdate( 'cascade' )
                ->onDelete( 'cascade' );
            $table->unsignedInteger('category_id');
            $table->foreign( 'category_id' )
                ->references( 'id' )->on( 'categories' )
                ->onUpdate( 'cascade' )
                ->onDelete( 'cascade' );
            $table->enum('item_type', ['beerglasses', 'beerashtrays', 'beercontainers', 'beerlabels', 'beerbottles', 'beerplateaus', 'beeradvertisements', 'beercoasters', 'beerstonejugs' ]);
            $table->string('item_name');
            $table->text('item_description');
            $table->unsignedInteger('item_amount')->default('0');
            $table->boolean('item_wishlist')->default(false);
            $table->string('item_type_1')->nullable();
            $table->string('item_text')->nullable();;
            $table->string('item_color')->nullable();
            $table->string('item_text_color')->nullable();
            $table->string('item_type_print')->nullable();
            $table->string('item_drawing')->nullable();
            $table->string('item_cluster')->nullable();
            $table->integer('item_height')->nullable();
            $table->integer('item_width')->nullable();
            $table->integer('item_length')->nullable();
            $table->integer('item_diameter_top')->nullable();
            $table->integer('item_diameter_bottom')->nullable();
            $table->integer('item_weight')->nullable();
            $table->string('item_size_indication')->nullable();
            $table->string('item_rib_type')->nullable();
            $table->string('item_facets')->nullable();
            $table->string('item_model')->nullable();
            $table->string('item_material')->nullable();
            $table->dateTime('item_year')->nullable();
            $table->string('item_language')->nullable();
            $table->integer('item_size')->nullable();  //maat
            $table->string('item_boxes')->nullable(); //vakken
            $table->string('item_extra_1')->nullable(); //vakken
            $table->string('item_extra_2')->nullable(); //vakken

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
        Schema::dropIfExists('beeritems');
    }
}
