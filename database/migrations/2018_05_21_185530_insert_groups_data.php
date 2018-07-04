<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Group;

class InsertGroupsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		$group = new Group([
		    'name' => 'Alaska on the Island Princess August',
		    'url' => 'alaskaontheislandprincessaugust',
		    'email' => 'jliescheidt@dt.com',
			'ship_id' => '1',
		    'sail_date' => '2018-08-23 00:00:00',
		    'duration' => '7',
		    'text' => 'NOW IS THE TIME to reserve your tours for this exciting voyage! Below are the most popular tours in each port. <a href="https://www.shoreexcursionsgroup.com/results">Click here</a> to view a full list of excursions available based on your time in port. All tours are first come, first served. So, don\'t delay. We would not want you to miss out!!',
		    'image' => '//media0.shoreexcursionsgroup.com/docs/groups/1117.jpg'
	    ]);

	    $group->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    \App\Group::query()->delete();
    }
}
