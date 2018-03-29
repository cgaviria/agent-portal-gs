<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Library\RestResponse;

use App\User;
use Activation;
use Sentinel;
use Reminder;
use URL;
use Lang;

class AuthController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const KEEP_LOGIN_YES = 'YES';

    public static $rules_login = array(
        'accountName'     => 'required|email',
        'accountPassword'  => 'required'
    );

    public function doLogin (Request $request)
    {


        $response = new \stdClass();
        $response->error  = false;
        $response->errmens = [];

        $validator = Validator::make(Input::all(), self::$rules_login);

        if ($validator->fails())
        {
            $response->error  = true;
            $response->errmens = $validator->messages();
            return RestResponse::sendResult(200,$response);
        }

        $credentials = [
            'email' => $request -> input('accountName'),
            'password' => $request -> input('accountPassword'),
        ];

        if ($request->keep_login == self::KEEP_LOGIN_YES)
        {
            $res = Sentinel::authenticateAndRemember($credentials);
        } else {
            $res = Sentinel::authenticate($credentials);
        }

        if ($res != null)
        {
            $response->mens = Lang::get('login_ok');
            if ($request->redirect == '')
            {
                $response->redirect = URL::action('AdminController@getIndex');
            } else {
                $response->redirect = $request->redirect;
            }
            
        } else {
            $response->error = true;
            $response->errmens = ['login' => [Lang::get('auth.failed')]];
            return RestResponse::sendResult (200,$response);
        }

        return RestResponse::sendResult (200,$response);
    }

    public function logout ()
    {

        Sentinel::logout();
        return redirect()->route('dashboard_login');
    }
}