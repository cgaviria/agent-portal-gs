<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class SysVariables extends Model {

    protected $table = "sys_variables";
	protected $primaryKey = "id";
	public $timestamps = true;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key','value'
    ];

}

