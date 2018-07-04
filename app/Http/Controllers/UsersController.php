<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\CancelBooking;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

use App\Library\RestResponse;

use Sentinel;
use Lang;
use URL;
use App\Booking;
use Yajra\DataTables\DataTables;    

class UsersController extends Controller
{
    
    /**
	 * Gets the My Account page to make user edits.
	 *
	 * @return Response
	 */
	public function getMyAccount(Request $request)
	{
		$logged_in_user = Sentinel::getUser();

		return view('admin.my_account', ['logged_in_user' => $logged_in_user]);
	}

	/**
	 * Get the Admin Table
	 *
	 * @return Response
	 */
	public function postMyAccount(Request $request)
	{
		$user_check = Sentinel::check();

		$validation_rules = User::$rules;

		if ($user_check) {
			$logged_in_user = Sentinel::getUser();

			$logged_in_user->first_name = $request->input('first_name');
			$logged_in_user->last_name = $request->input('last_name');
			$logged_in_user->email = $request->input('email');

			if ($change_password = $request->input('password')) {
				if ($change_password == $request->input('password_confirmation')) {
					$logged_in_user->password = $change_password;
				}
			} else {
				unset($validation_rules['password']);
				unset($validation_rules['password_confirmation']);
			}

			$validation_rules['email'] = array('required', 'email', Rule::unique('users')->ignore($logged_in_user->id));

			$validator = Validator::make($request->all(), $validation_rules);

			if ($validator->fails()) {
				return response()->json([
					'status' => 'alert',
					'data' => $validator->errors()
				]);
			} else {
				if ($uploaded_file = $request->file('photo')) {
					$logged_in_user->changePhoto($uploaded_file);
				}

				$logged_in_user->save();

				return response()->json([
					'status' => 'success',
					'data' => array(
						'new_user_info' => $logged_in_user,
						'redirect' => action('AdminController@getIndex'),
						'message' => Lang::get('Your account was successfully modified.')
					)
				]);
			}
		}
	}
}