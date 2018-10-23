<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddApiKeyAgency extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agencies', function($table) {
            $table->string('api_key');
        });
        $results = DB::table('agencies')->select('id','api_key')->get();
        $i = 1;
        foreach ($results as $result){
            DB::table('agencies')
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
