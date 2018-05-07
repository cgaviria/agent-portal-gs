<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class ImportedBooking extends Model{

    protected $table = "imported_bookings";
	protected $primaryKey = "id";
	public $timestamps = true;

	public function User(){
		return $this->belongsTo('App\User','user_id','id');
	}

	public function ContactImporter(){
		return $this->belongsTo('App\ContactImporter','contact_importer_id','id');
	}
}

