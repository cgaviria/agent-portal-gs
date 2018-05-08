<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Ship extends Model{

    protected $table = "booking_ships";
	protected $primaryKey = "id";
	public $timestamps = true;

	public function Company(){
		return $this->belongsTo('App\Company','company_id','id');
	}
}

