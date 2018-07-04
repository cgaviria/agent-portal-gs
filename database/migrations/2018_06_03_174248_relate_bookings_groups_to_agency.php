<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelateBookingsGroupsToAgency extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    \App\Relationships\AgenciesGroups::query()->delete();

    	foreach (\App\Group::all() as $group) {
		    $rel_agency_group = new \App\Relationships\AgenciesGroups([
			    'agency_id' => 2,
			    'group_id' => $group->id
		    ]);

		    $rel_agency_group->save();
	    }

	    \App\Booking::where('id', '>=', 1)->update(['agency_id' => 2]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    \App\Booking::where('id', '>=', 1)->update(['agency_id' => null]);

	    \App\Relationships\AgenciesGroups::query()->delete();

	    $rel_agency_group = new \App\Relationships\AgenciesGroups([
		    'agency_id' => 2,
		    'group_id' => 256
	    ]);

	    $rel_agency_group->save();
    }
}
