<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertBookingsAndGroupsData extends Migration
{
	public function __construct()
	{
		DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
	}

	/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('bookings', function (Blueprint $table) {
		    // change() tells the Schema builder that we are altering a table
		    $table->integer('group_id')->nullable()->change();
	    });

    	for ($k = 0 ; $k < 75; $k++) {
		    $group = new \App\Group([
			    'name' => 'Alaska on the Island Princess August',
			    'url' => 'alaskaontheislandprincessaugust2',
			    'email' => 'jliescheidt@dt.com',
			    'ship_id' => '1',
			    'sail_date' => '2018-08-23 00:00:00',
			    'duration' => '7',
			    'text' => 'NOW IS THE TIME to reserve your tours for this exciting voyage! Below are the most popular tours in each port. <a href="https://www.shoreexcursionsgroup.com/results">Click here</a> to view a full list of excursions available based on your time in port. All tours are first come, first served. So, don\'t delay. We would not want you to miss out!!',
			    'image' => '//media0.shoreexcursionsgroup.com/docs/groups/1117.jpg'
		    ]);

		    $group->save();
	    }

	    for ($k = 0 ; $k < 100; $k++) {
		    $booking = new \App\Booking([
			    'order_id' => 172304 + $k,
			    'order_date' => '2016/07/08',
			    'order_status' => 'processing',
			    'order_notes' => 'This is a test note for a booking.',
			    'payment_received' => true,
			    'paymentAmount' => '50.00',
			    'customer_phone_number' => '561-287-2003',
			    'customer_email_address' => 'christiangaviria@christiangaviria.com',
			    'customer_email_sent' => true,
			    'first_name' => 'Christian',
			    'last_name' => 'Gaviria',
			    'agency_data' => '',
			    'agency_email_address' => '',
			    'agency_name' => '',
			    'agency_branding' => false,
			    'agency_bcc' => true,
			    'review_email_disabled' => true,
			    'ship_id' => '1',
			    'cruise_start_date' => '2018/09/09',
			    'cruise_duration' => '7',
			    'customer_notes' => 'This is a test customer note.',
			    'notes_to_vendor' => 'This is a test note to vendor.',
			    'accounting_notes' => 'This is a test accounting note.',
			    'hold_emails_for_tour' => false,
			    'product_code' => 'BLTEST1_STANDARD',
			    'product_name' => 'TEST Standard Tour',
			    'options_list' => '',
			    'qty_adult' => '1',
			    'qty_children' => '1',
			    'quantity' => '2',
			    'discount_row' => false,
			    'total_price' => '230.00',
			    'affiliate_payment' => '30.00',
			    'total_vendor_cost' => '10.00',
			    'auto_confirm' => true,
			    'over_ride' => false,
			    'itinerary_works' => '',
			    'tour_date' => '2018/10/10',
			    'tour_time' => '9:00am',
			    'tour_duration' => '3 hours',
			    'buffer_time' => '15 minutes',
			    'vendor_title' => '',
			    'vendor_currency' => 'USD',
			    'port' => '',
			    'port_arrival' => '2018/11/11',
			    'port_departure' => '2018/11/17'
		    ]);

		    $booking->save();
	    }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    \App\Group::where('url', 'alaskaontheislandprincessaugust2')->delete();

	    \App\Booking::query()->delete();

	    Schema::table('bookings', function (Blueprint $table) {
		    // change() tells the Schema builder that we are altering a table
		    $table->integer('group_id')->nullable(false)->change();
	    });
    }
}
