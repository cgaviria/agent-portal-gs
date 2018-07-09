<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetAgenciesToOwnerId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    $admin_user = \App\User::where('email' , '=', 'christiangaviri@gmail.com')->first();

	    \App\Agency::where('name', '=', 'Agency Test One')
		    ->orWhere('name', '=', 'Agency Test One')
		    ->update(['owner_id' => $admin_user->id]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    \App\Agency::where('name', '=', 'Agency Test One')
		    ->orWhere('name', '=', 'Agency Test One')
		    ->update(['owner_id' => null]);
    }
}
