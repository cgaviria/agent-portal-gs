<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model{

    protected $table = "cruise_companies";
	protected $primaryKey = "id";
	public $timestamps = true;
}

