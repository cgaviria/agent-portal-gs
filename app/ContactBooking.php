<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactBooking extends Model{

    protected $table = "contact_bookings";
	protected $primaryKey = "id";
	public $timestamps = true;

	public function ImportedBooking(){
		return $this->belongsTo('App\ImportedBooking','booking_id','id');
	}
}

