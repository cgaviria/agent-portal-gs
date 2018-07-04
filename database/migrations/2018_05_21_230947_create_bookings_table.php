<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
	        $table->increments('id');
	        $table->unsignedInteger('order_id')->nullable();
	        $table->datetime('order_date')->nullable();
	        $table->string('order_status', 255)->nullable();
	        $table->text('order_notes')->nullable();
	        $table->boolean('payment_received')->nullable();
	        $table->decimal('payment_amount', 10, 4)->nullable();
	        $table->unsignedInteger('customer_id')->nullable();
	        $table->string('customer_phone_number', 30)->nullable();
	        $table->string('customer_email_address', 75)->nullable();
	        $table->boolean('customer_email_sent')->nullable();
	        $table->string('first_name', 30)->nullable();
	        $table->string('last_name', 40)->nullable();
	        $table->unsignedInteger('agency_id')->nullable();
	        $table->string('agency_data', 255)->nullable();
	        $table->unsignedInteger('group_id');
	        $table->string('agency_email_address', 75)->nullable();
	        $table->string('agency_name', 255)->nullable();
	        $table->boolean('agency_branding')->nullable();
	        $table->unsignedInteger('agency_branding_id')->nullable();
	        $table->boolean('agency_bcc')->nullable();
	        $table->boolean('review_email_disabled')->nullable();
	        $table->unsignedInteger('ship_id')->nullable();
	        $table->datetime('cruise_start_date')->nullable();
	        $table->string('cruise_duration', 50)->nullable();
	        $table->text('customer_notes')->nullable();
	        $table->string('notes_to_vendor', 255)->nullable();
	        $table->string('accounting_notes', 255)->nullable();
	        $table->boolean('hold_emails_for_tour')->nullable();
	        $table->string('product_code', 30)->nullable();
	        $table->string('product_name', 255)->nullable();
	        $table->text('options_list')->nullable();
	        $table->integer('qty_adult')->nullable();
	        $table->integer('qty_children')->nullable();
	        $table->integer('quantity')->nullable();
	        $table->boolean('discount_row')->nullable();
	        $table->decimal('total_price', 10, 4)->nullable();
	        $table->decimal('affiliate_payment', 10, 4)->nullable();
	        $table->decimal('total_vendor_cost', 10, 4)->nullable();
	        $table->string('auto_confirm', 10)->nullable();
	        $table->boolean('over_ride')->nullable();
	        $table->string('itinerary_works', 255)->nullable();
	        $table->datetime('tour_date')->nullable();
	        $table->string('tour_time', 100)->nullable();
	        $table->string('tour_duration', 100)->nullable();
	        $table->string('buffer_time', 255)->nullable();
	        $table->unsignedInteger('vendor_id')->nullable();
	        $table->string('vendor_title', 50)->nullable();
	        $table->string('vendor_currency', 4)->nullable();
	        $table->string('port', 255)->nullable();
	        $table->datetime('port_arrival')->nullable();
	        $table->datetime('port_departure')->nullable();
	        $table->datetime('localize_port_arrival')->nullable();
	        $table->datetime('localize_port_departure')->nullable();
	        $table->enum('status_color', ['B', 'G', 'H', 'O', 'R', 'Y'])->nullable();
	        $table->string('auto_process', 100)->nullable();
	        $table->string('check_stub', 100)->nullable();
	        $table->enum('last_response', ['A','H','P','R','S'])->nullable();
	        $table->enum('response_direction', ['V','M','C'])->nullable();
	        $table->datetime('response_received')->nullable();
	        $table->text('response_notes')->nullable();
	        $table->datetime('suggested_date')->nullable();
	        $table->string('suggested_time', 255)->nullable();
	        $table->string('suggested_location', 400)->nullable();
	        $table->string('bundle_product', 255)->nullable();
	        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
