<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model {

    protected $table = "agencies";
	protected $primaryKey = "id";
	public $timestamps = true;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];
}

