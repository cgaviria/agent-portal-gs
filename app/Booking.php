<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model{

    protected $table = "booking";
	protected $primaryKey = "id";
	public $timestamps = true;

	public function Ship(){
		return $this->HasOne('App\Ship','ship_id','id');
	}
}

