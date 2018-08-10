<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertDummyClients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         for ($k = 0 ; $k < 50; $k++) {
            $client = new \App\Client([
                'first_name'=>'test',
                'last_name'=>'test',
                'email'=>'test'.$k.'@gmail.com',
                'ship_id'=>3,
                'sail_date'=>'2018-07-26',
                'duration'=>'2',
                'created_at'=>'2018-01-25 07:22:21',
                'user_id' => 29 ]);

            $client->save();
        }
         for ($k = 0 ; $k < 20; $k++) {
            $client = new \App\Client([
                'first_name'=>'test',
                'last_name'=>'test',
                'email'=>'test'.$k.'@gmail.com',
                'ship_id'=>3,
                'sail_date'=>'2018-07-26',
                'duration'=>'2',
                'created_at'=>'2018-02-25 07:22:21',
                'user_id' => 29 ]);

            $client->save();
        }
         for ($k = 0 ; $k < 40; $k++) {
            $client = new \App\Client([
                'first_name'=>'test',
                'last_name'=>'test',
                'email'=>'test'.$k.'@gmail.com',
                'ship_id'=>3,
                'sail_date'=>'2018-07-26',
                'duration'=>'2',
                'created_at'=>'2018-03-25 07:22:21',
                'user_id' => 29 ]);

            $client->save();
        }
         for ($k = 0 ; $k < 15; $k++) {
            $client = new \App\Client([
                'first_name'=>'test',
                'last_name'=>'test',
                'email'=>'test'.$k.'@gmail.com',
                'ship_id'=>3,
                'sail_date'=>'2018-07-26',
                'duration'=>'2',
                'created_at'=>'2018-04-25 07:22:21',
                'user_id' => 29 ]);

            $client->save();
        }
         for ($k = 0 ; $k < 60; $k++) {
            $client = new \App\Client([
                'first_name'=>'test',
                'last_name'=>'test',
                'email'=>'test'.$k.'@gmail.com',
                'ship_id'=>3,
                'sail_date'=>'2018-07-26',
                'duration'=>'2',
                'created_at'=>'2018-05-25 07:22:21',
                'user_id' => 29 ]);

            $client->save();
        }
         for ($k = 0 ; $k < 10; $k++) {
            $client = new \App\Client([
                'first_name'=>'test',
                'last_name'=>'test',
                'email'=>'test'.$k.'@gmail.com',
                'ship_id'=>3,
                'sail_date'=>'2018-07-26',
                'duration'=>'2',
                'created_at'=>'2018-06-25 07:22:21',
                'user_id' => 29 ]);

            $client->save();
        }
        for ($k = 0 ; $k < 10; $k++) {
            $client = new \App\Client([
                'first_name'=>'test',
                'last_name'=>'test',
                'email'=>'test'.$k.'@gmail.com',
                'ship_id'=>3,
                'sail_date'=>'2018-07-26',
                'duration'=>'2',
                'created_at'=>'2018-7-25 07:22:21',
                'user_id' => 29 ]);

            $client->save();
        }
        for ($k = 0 ; $k < 10; $k++) {
            $client = new \App\Client([
                'first_name'=>'test',
                'last_name'=>'test',
                'email'=>'test'.$k.'@gmail.com',
                'ship_id'=>3,
                'sail_date'=>'2018-07-26',
                'duration'=>'2',
                'created_at'=>'2018-08-25 07:22:21',
                'user_id' => 29 ]);

            $client->save();
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
