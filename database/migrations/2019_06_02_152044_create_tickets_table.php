<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->foreign( 'user_id' )
                ->references( 'id' )->on( 'users' )
                ->onUpdate( 'cascade' );
            $table->integer('type_id')->unsigned();;
            $table->string('ticket_id')->unique();
            $table->string('ticket_title');
            $table->string('ticket_priority');
            $table->longText('ticket_description');
            $table->string('ticket_status');
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
        Schema::dropIfExists('Tickets');
    }
}
