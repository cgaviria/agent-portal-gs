<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->integer('ship_id');
            $table->datetime('sail_date');
            $table->integer('duration');
            $table->string('itinerary')->nullable();
            $table->timestamps();
        });
        $client = new \App\Client([
            'first_name' => 'test',
            'last_name'=>'test',
            'email'=>'test2@gmail.com',
            'ship_id'=>2,
            'sail_date'=>'2018-05-04 00:00:00',
            'duration'=> 4,
            
        ]);

        $client->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
