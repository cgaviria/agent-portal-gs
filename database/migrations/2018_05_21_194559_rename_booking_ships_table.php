<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameBookingShipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('groups', function (Blueprint $table) {
	        $table->dropForeign(['ship_id']);
        });

	    Schema::table('booking', function (Blueprint $table) {
		    $table->dropForeign(['ship_id']);
	    });

	    Schema::rename('booking_ships', 'cruise_ships');

	    Schema::table('groups', function (Blueprint $table) {
		    $table->foreign('ship_id')->references('id')->on('cruise_ships')->onDelete('cascade')->nullable();
	    });

	    Schema::table('booking', function (Blueprint $table) {
		    $table->foreign('ship_id')->references('id')->on('cruise_ships')->onDelete('cascade')->nullable();
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('groups', function (Blueprint $table) {
		    $table->dropForeign(['ship_id']);
	    });

	    Schema::table('booking', function (Blueprint $table) {
		    $table->dropForeign(['ship_id']);
	    });

	    Schema::rename('cruise_ships', 'booking_ships');

    	Schema::table('groups', function (Blueprint $table) {
		    $table->foreign('ship_id')->references('id')->on('booking_ships')->onDelete('cascade')->nullable();
		});

	    Schema::table('booking', function (Blueprint $table) {
		    $table->foreign('ship_id')->references('id')->on('booking_ships')->onDelete('cascade');
		});
    }
}
