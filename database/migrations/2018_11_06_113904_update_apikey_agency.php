<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB as DB;

class UpdateApikeyAgency extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
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
