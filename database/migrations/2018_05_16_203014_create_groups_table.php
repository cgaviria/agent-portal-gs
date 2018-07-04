<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('name', 2500);
	        $table->string('url', 2500)->nullable();
	        $table->string('email', 2500)->nullable();
	        $table->dateTime('sail_date')->nullable();
	        $table->unsignedInteger('ship_id');
	        $table->foreign('ship_id')->references('id')->on('booking_ships')->onDelete('cascade')->nullable();
			$table->integer('duration')->nullable();
	        $table->string('text', 2500)->nullable();
	        $table->string('image', 2500)->nullable();
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
        Schema::dropIfExists('groups');
    }
}
