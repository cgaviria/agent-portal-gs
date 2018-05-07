<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Import extends Model{

    protected $table = "imports";
	protected $primaryKey = "id";
	public $timestamps = true;

	public function ContactImporter(){
		return $this->belongsTo('App\ContactImporter','importer_id','id');
	}
}

