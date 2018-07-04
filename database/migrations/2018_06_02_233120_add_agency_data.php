<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAgencyData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    $agency = new \App\Agency([
		    'name' => 'Agency Test One'
	    ]);

	    $agency->save();

	    \App\User::where('id', '>=', 1)->update(['agency_id' => $agency->id]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    \App\User::where('id', '>=', 1)->update(['agency_id' => 0]);

    	\App\Agency::query()->delete();
    }
}
