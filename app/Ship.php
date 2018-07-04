<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Ship extends Model{

    protected $table = "cruise_ships";
	protected $primaryKey = "id";
	public $timestamps = true;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','company_id'
    ];

	public function Company(){
		return $this->belongsTo('App\Company','company_id','id');
	}
}

