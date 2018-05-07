<?php

namespace App\Library;


class TravelerLeadersBusiness {
    

	public static function findContacts($data){

		$passengers = [];
		foreach ($data->structs as $key => $value) {
			if($value->title == "PASSENGER DETAILS"){
				$c = 0;
				foreach ($value->data as $key => $value) {
				 	if($c == 0){
				 		$passenger =  new \stdClass;
				 	}
				 	switch ($c) {
				 		case 0:
				 			$passenger->name = $value;
				 		break;
				 		case 1:
				 			$passenger->email = $value;
				 		break;
				 		case 2:
				 			$passenger->birth = $value;
				 		break;
				 		case 3:
				 			$passenger->citizenship = $value;
				 		break;
				 	}
				 	$c++;
				 	if($c == 4){
				 		$passengers[] = $passenger;
				 		$c = 0;
				 	}
				} 
			}
		}
		
		return $passengers;
	}

    public static function parseEmail($email_text){
    	$data = explode("\n", $email_text);
		//dd($data);
		$cr = 0;
		$sw_ini = false;
		$sw_ems = false;
		$data_export = new \stdClass();
		for ($i = 0; $i < count($data); $i++) {
			$line = $data[$i];
			if($line === "\r"){
				$cr++;
			}else{
				$cr = 0;
			}
			if($cr == 3){
				if(!$sw_ini){
					$sw_ini = true;
				}else{
					$sw_ems = true;
				}
			}

			if($sw_ems){
				if(!isset($data_export->confNumber)){
					$i++;
					$line = $data[$i];
					$posini = strrpos($line, ':')+2;
					$length = strrpos($line, ')',$posini)-$posini;
					$data_export->confNumber = substr($line, $posini, $length);
				}else{
					if($line == "| \r" || ($data[$i] == "\r" && $data[$i-1] == "\r" && $data[$i-2] == "\r")){
						$res = self::subStructure($data,$i);
						$i = $res[0];
						if($res[1]){
							$data_export->structs[] = $res[1];
						}
					}
				}
			}
		}

		return $data_export;
    }

    private static function subStructure($data,$it){

    	$struc = new \stdClass();
    	$struc->data = [];
    	$it++;
    	$vc = 1;
    	for ($i = $it; $i < count($data); $i++) {
    		$line = $data[$i];
    		if($i == $it){
    			$struc->title = trim(str_replace(["\r","|"], '', $line));
    		}else{
    			$linedata = explode("|", $line);
    			if(count($linedata) == 4){
    				$key = str_replace(':', '', trim($linedata[1]));
    				if($data[$i-1] == "\r" && $data[$i-2] == "\r"){
    					$vc++;
    				}
    				$struc->data[$vc != 1 ? $key.'_'.$vc : $key] = trim($linedata[2]);
    			}
    		}

    		if($line == " |\r"){
    			break;
    		}
    	}

    	return [$i, count($struc->data) > 0 ? $struc : null];
    }
}



?>