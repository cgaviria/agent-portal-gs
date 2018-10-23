<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SysVariables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('sys_variables', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('key')->unique();
            $table->integer('value');
        });

        DB::table('sys_variables')->insert([
            ['key' => 'ADMIN_APIKEY', 'value' => rand()]
        ]);
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
