<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model {

    protected $table = "clients";
	protected $primaryKey = "id";
	public $timestamps = true;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name','email','ship_id','sail_date','duration'
    ];

	

	public function getFullName(){
		$full_name = '';

		if ($this->first_name) {
			$full_name = $this->first_name;
		}
		if ($this->last_name) {
			$full_name .= ' ' . $this->last_name;
		}

		return trim($full_name);
	}

	static function getTableName() {
		static $instance;

		if (!$instance) {
			$instance = new self();
		}

		return $instance->table;
	}
}

