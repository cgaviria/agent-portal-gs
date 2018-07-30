<?php
namespace App\Traits;

use App\Activities;

trait ActivitesTrait {
    public function insertActivity($url,$description,$userid) {
       
        $ci = new Activities;
		$ci->url = $url;
		$ci->description = $description;
		$ci->user_id = $userid;
		$ci->save();
    }
}