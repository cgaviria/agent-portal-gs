<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertDummyGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        for ($k = 0 ; $k < 15; $k++) {
            $group = new \App\Group([
                'name' => 'test',
                'url' => 'alaskaontheislandprincessaugust2',
                'email' => 'jliescheidt@dt.com',
                'ship_id' => '1',
                'sail_date' => '2018-01-23 00:00:00',
                'duration' => '7',
                'text' => 'NOW IS THE TIME to reserve your tours for this exciting voyage! Below are the most popular tours in each port. <a href="https://www.shoreexcursionsgroup.com/results">Click here</a> to view a full list of excursions available based on your time in port. All tours are first come, first served. So, don\'t delay. We would not want you to miss out!!',
                'image' => '//media0.shoreexcursionsgroup.com/docs/groups/1117.jpg',
                'created_at'=> '2018-01-23 00:00:00',
            ]);

            $group->save();
        }
        for ($k = 0 ; $k < 5; $k++) {
            $group = new \App\Group([
                'name' => 'test',
                'url' => 'alaskaontheislandprincessaugust2',
                'email' => 'jliescheidt@dt.com',
                'ship_id' => '1',
                'sail_date' => '2018-02-23 00:00:00',
                'duration' => '7',
                'text' => 'NOW IS THE TIME to reserve your tours for this exciting voyage! Below are the most popular tours in each port. <a href="https://www.shoreexcursionsgroup.com/results">Click here</a> to view a full list of excursions available based on your time in port. All tours are first come, first served. So, don\'t delay. We would not want you to miss out!!',
                'image' => '//media0.shoreexcursionsgroup.com/docs/groups/1117.jpg',
                'created_at'=> '2018-02-23 00:00:00',
            ]);

            $group->save();
        }
        for ($k = 0 ; $k < 23; $k++) {
            $group = new \App\Group([
                'name' => 'test',
                'url' => 'alaskaontheislandprincessaugust2',
                'email' => 'jliescheidt@dt.com',
                'ship_id' => '1',
                'sail_date' => '2018-03-23 00:00:00',
                'duration' => '7',
                'text' => 'NOW IS THE TIME to reserve your tours for this exciting voyage! Below are the most popular tours in each port. <a href="https://www.shoreexcursionsgroup.com/results">Click here</a> to view a full list of excursions available based on your time in port. All tours are first come, first served. So, don\'t delay. We would not want you to miss out!!',
                'image' => '//media0.shoreexcursionsgroup.com/docs/groups/1117.jpg',
                'created_at'=> '2018-03-23 00:00:00',
            ]);

            $group->save();
        }
        for ($k = 0 ; $k < 15; $k++) {
            $group = new \App\Group([
                'name' => 'test',
                'url' => 'alaskaontheislandprincessaugust2',
                'email' => 'jliescheidt@dt.com',
                'ship_id' => '1',
                'sail_date' => '2018-04-23 00:00:00',
                'duration' => '7',
                'text' => 'NOW IS THE TIME to reserve your tours for this exciting voyage! Below are the most popular tours in each port. <a href="https://www.shoreexcursionsgroup.com/results">Click here</a> to view a full list of excursions available based on your time in port. All tours are first come, first served. So, don\'t delay. We would not want you to miss out!!',
                'image' => '//media0.shoreexcursionsgroup.com/docs/groups/1117.jpg',
                'created_at'=> '2018-04-23 00:00:00',
            ]);

            $group->save();
        }
        for ($k = 0 ; $k < 35; $k++) {
            $group = new \App\Group([
                'name' => 'test',
                'url' => 'alaskaontheislandprincessaugust2',
                'email' => 'jliescheidt@dt.com',
                'ship_id' => '1',
                'sail_date' => '2018-05-23 00:00:00',
                'duration' => '7',
                'text' => 'NOW IS THE TIME to reserve your tours for this exciting voyage! Below are the most popular tours in each port. <a href="https://www.shoreexcursionsgroup.com/results">Click here</a> to view a full list of excursions available based on your time in port. All tours are first come, first served. So, don\'t delay. We would not want you to miss out!!',
                'image' => '//media0.shoreexcursionsgroup.com/docs/groups/1117.jpg',
                'created_at'=> '2018-05-23 00:00:00',
            ]);

            $group->save();
        }
        for ($k = 0 ; $k < 25; $k++) {
            $group = new \App\Group([
                'name' => 'test',
                'url' => 'alaskaontheislandprincessaugust2',
                'email' => 'jliescheidt@dt.com',
                'ship_id' => '1',
                'sail_date' => '2018-01-23 00:00:00',
                'duration' => '7',
                'text' => 'NOW IS THE TIME to reserve your tours for this exciting voyage! Below are the most popular tours in each port. <a href="https://www.shoreexcursionsgroup.com/results">Click here</a> to view a full list of excursions available based on your time in port. All tours are first come, first served. So, don\'t delay. We would not want you to miss out!!',
                'image' => '//media0.shoreexcursionsgroup.com/docs/groups/1117.jpg',
                'created_at'=> '2018-06-23 00:00:00',
            ]);

            $group->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
