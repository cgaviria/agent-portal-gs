<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddApiKeyUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('users', function($table) {
            $table->string('api_key');
        });
        $results = DB::table('users')->select('id','api_key')->get();
        $i = 1;
        foreach ($results as $result){
            DB::table('users')
                ->where('id',$result->id)
                ->update([
                    "api_key" => rand()
            ]);
            $i++;
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
