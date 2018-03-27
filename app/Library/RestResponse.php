<?php

namespace App\Library;


class RestResponse {
    
    public static function sendResult($status,$data){

        $res = array();
        $res['data'] = $data;
        
        $json_res = json_encode($res);
        
        return response($json_res, $status)->header('Content-Type', 'text/plain');
    }
}



?>