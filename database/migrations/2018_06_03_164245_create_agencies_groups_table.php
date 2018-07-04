<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgenciesGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencies_groups', function (Blueprint $table) {
            $table->increments('id');
	        $table->unsignedInteger('agency_id');
	        $table->unsignedInteger('group_id');
            $table->timestamps();
        });

	    $rel_agency_group = new \App\Relationships\AgenciesGroups([
		    'agency_id' => 2,
		    'group_id' => 256
	    ]);

	    $rel_agency_group->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agencies_groups');
    }
}
