<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactImporter extends Model{

    protected $table = "contact_importer";
	protected $primaryKey = "id";
	public $timestamps = true;

	public function User(){
		return $this->belongsTo('App\User','user_id','id');
	}
}

