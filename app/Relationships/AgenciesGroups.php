<?php
namespace App\Relationships;

use Illuminate\Database\Eloquent\Model;

class AgenciesGroups extends Model {

    protected $table = "agencies_groups";
	protected $primaryKey = "id";
	public $timestamps = true;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agency_id','group_id'
    ];

	public function agency(){
		return $this->belongsTo('App\Agency','agency_id','id');
	}

	public function group(){
		return $this->belongsTo('App\Group','group_id','id');
	}
}

