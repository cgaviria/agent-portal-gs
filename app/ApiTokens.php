<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiTokens extends Model {

    protected $table = "api_tokens";
	protected $primaryKey = "id";
	public $timestamps = true;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'token_string','user_id','unix_timestamp','valid_until'
    ];

}

