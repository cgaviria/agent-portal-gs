<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model{

    protected $table = "groups";
	protected $primaryKey = "id";
	public $timestamps = true;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','url','email','sail_date','ship_id','duration','text','image'
    ];

	public function ship(){
		return $this->belongsTo('App\Ship','ship_id','id');
	}

	public function getBookings()
	{
		return Booking::where('group_id', $this->id)
			->orderBy('created_at', 'desc')
			->get();
	}
}

