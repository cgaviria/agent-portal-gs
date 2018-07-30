<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Activities extends Model {

    protected $table = "activities";
	protected $primaryKey = "id";
	public $timestamps = true;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url','description','user_id'
    ];

}

