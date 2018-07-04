<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model {

    protected $table = "bookings";
	protected $primaryKey = "id";
	public $timestamps = true;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'order_date', 'order_status','order_notes', 'payment_received', 'payment_amount', 'customer_id',
	    'customer_phone_number', 'customer_email_address', 'customer_email_sent', 'first_name', 'last_name', 'agency_id', 'agency_data', 'group_id',
	    'agency_email_address', 'agency_name', 'agency_branding', 'agency_branding_id', 'agency_bcc', 'review_email_disabled', 'ship_id', 'cruise_start_date',
	    'cruise_duration', 'customer_notes', 'notes_to_vendor', 'accounting_notes', 'hold_emails_for_tour', 'product_code', 'product_name', 'options_list', 'qty_adult',
	    'qty_children', 'quantity', 'discount_row', 'total_price', 'affiliate_payment', 'total_vendor_cost', 'auto_confirm', 'over_ride', 'itinerary_works', 'tour_date',
	    'tour_time', 'tour_duration', 'buffer_time', 'vendor_id', 'vendor_title', 'vendor_currency', 'port', 'port_arrival', 'port_departure', 'localize_port_arrival', 'localize_port_departure',
	    'status_color', 'auto_process', 'check_stub', 'last_response', 'response_direction', 'response_received', 'response_notes', 'suggested_date', 'suggested_time', 'suggested_location', 'bundle_product'
    ];

	public function ship(){
		return $this->HasOne('App\Ship','id','ship_id');
	}

	public function group(){
		return $this->HasOne('App\Group','id','group_id');
	}

	public function getFullName(){
		$full_name = '';

		if ($this->first_name) {
			$full_name = $this->first_name;
		}
		if ($this->last_name) {
			$full_name .= ' ' . $this->last_name;
		}

		return trim($full_name);
	}

	static function getTableName() {
		static $instance;

		if (!$instance) {
			$instance = new self();
		}

		return $instance->table;
	}
}

