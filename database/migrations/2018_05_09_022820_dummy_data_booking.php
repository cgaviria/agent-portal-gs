<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Company;
use App\Booking;
use App\Ship;

class DummyDataBooking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('booking', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        $company =
            [
                'name'=>"White Line"
            ];

        $sp = new Company($company);
        $sp->save();

        $ship =
            [
                'name'=>"Titanic",
                'company_id'=>"1"
            ];

        $s = new Ship($ship);
        $s->save();

        $booking =
            [
                'booking_number'=>"GTF123",
                'first_name'=>"David",
                'last_name'=>"Royo",
                'sail_date'=>"2019-02-01",
                'user_id'=>"1",
                'ship_id'=>"1"
            ];

        $b = new Booking($booking);
        $b->save();
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
