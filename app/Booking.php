<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model{

    protected $table = "booking";
	protected $primaryKey = "id";
	public $timestamps = true;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'booking_number', 'first_name', 'last_name','sail_date', 'ship_id'
    ];

	public function Ship(){
		return $this->HasOne('App\Ship','id','ship_id');
	}

	public function getFullName(){
		return $this->first_name . ' ' .$this->last_name;
	}
}

