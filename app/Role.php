<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    const ROLE_AGENT = 'agent';
	const ROLE_AGENCY_MANAGER = 'agency';
	const ROLE_OWNER = 'owner';
	const ROLE_ADMIN = 'admin';

	protected $table = "roles";
	protected $primaryKey = "id";
	public $timestamps = true;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug','name','permissions'
    ];
}

