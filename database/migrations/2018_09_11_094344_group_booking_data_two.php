<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GroupBookingDataTwo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          
            
        for ($k = 1 ; $k < 10; $k++) {
            $booking = new \App\Booking([
                'order_id' => 182304 + $k,
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
                'group_id'=>1647,
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
                'qty_adult' => $k,
                'qty_children' => $k+1,
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
                'port' => 'miami port',
                'port_arrival' => '2018/11/11',
                'port_departure' => '2018/11/17',
                'created_at'=>'2018-01-23 00:27:05',
                'agent_id'=> 32
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
        //
    }
}
