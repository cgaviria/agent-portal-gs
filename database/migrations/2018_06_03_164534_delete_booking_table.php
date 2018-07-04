<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::dropIfExists('booking');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::create('booking', function (Blueprint $table) {
		    $table->increments('id');
		    $table->string('booking_number')->unique();
		    $table->string('first_name');
		    $table->string('last_name');
		    $table->timestamp('sail_date');
		    $table->integer('ship_id')->unsigned();
		    $table->foreign('ship_id')->references('id')->on('booking_ships')->onDelete('cascade');
		    $table->timestamps();

		    $table->engine = 'InnoDB';
	    });
    }
}
