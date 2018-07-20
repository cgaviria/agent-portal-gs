<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\CancelBooking;
use App\Role;
use App\User;
use App\Agency;
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
use Activation;
use Lang;
use URL;
use App\Booking;
use Yajra\DataTables\DataTables;    

class AgencyController extends Controller
{
    public static $rules_add = array(
        'agency_name'  => 'required',
       
    );
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
			if ($user_id_to_edit = $request->input('user_id_to_edit')) {
				$logged_in_user = Sentinel::findById($user_id_to_edit);

				$users = User::query();

				$user = Sentinel::getUser();

				$users->where('users.id', '!=', $user->id);
				$users->where('users.id', $logged_in_user->id);

				if (!Sentinel::inRole(Role::ROLE_ADMIN)) {
					if ($user->agency_id && Sentinel::inRole(Role::ROLE_AGENCY_MANAGER)) {
						$agent_role = Sentinel::findRoleBySlug(Role::ROLE_AGENT);

						$users->select('users.*');

						$users->join('role_users', 'role_users.user_id', '=', 'users.id');

						$users->where('users.agency_id', $user->agency_id);
						$users->where('role_users.role_id', $agent_role->id);
					} else if (Sentinel::inRole(Role::ROLE_OWNER)) {
						$agent_role = Sentinel::findRoleBySlug(Role::ROLE_AGENT);
						$agency_manager_role = Sentinel::findRoleBySlug(Role::ROLE_AGENCY_MANAGER);

						$users->select('users.*');

						$users->join('agencies', 'agencies.id', '=', 'users.agency_id');
						$users->join('role_users', 'role_users.user_id', '=', 'users.id');

						$users->where('agencies.owner_id', $user->id);
						$users->whereNotNull('users.agency_id');

						$users->where(function($users) use ($agent_role, $agency_manager_role) {
							$users->where('role_users.role_id', $agent_role->id);
							$users->orWhere('role_users.role_id', $agency_manager_role->id);
						});
					} else {
						$users->limit(0);
					}
				}

				if (!$user_to_edit = $users->first()) {
					return response()->json([
						'status' => 'error',
						'data' => array('message' => 'You do not have permission to edit this user.')
					]);
				}
			} else {
				$logged_in_user = Sentinel::getUser();
			}

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
						'redirect' => (isset($user_id_to_edit)) ? action('UsersController@getEditUser', array($user_id_to_edit)) : action('AdminController@getIndex'),
						'message' => (isset($user_id_to_edit)) ? Lang::get('User was successfully modified.') : Lang::get('Your account was successfully modified.')
					)
				]);
			}
		}
	}

	/**
	 * Get the page that displays Users.
	 *
	 * @return Response
	 */
	public function getAgency(Request $request)
	{
		$param = array();
		$logged_in_user = Sentinel::getUser();
		
		$param['url']  = URL::action('AgencyController@getData');
		$param['fields'] = [
			[ 'id' => 'name', 'label' => 'Name', 'ordenable' => false,  'searchable' => false,  'className' => 'dt-body-center'],
			[ 'id' => 'actions', 'label' => 'Actions', 'ordenable' => false,  'searchable' => false, 'width' => '20%']
		];

		$param['order'] = ['order' => 0, 'way' => 'desc'];

		return view('admin.agent', ['datatables_params' => $param]);
	}

	/**
	 * Get the Admin Table
	 *
	 * @return Response
	 */
	public function getData(Request $request)
	{
		$user_check = Sentinel::check();

		if ($user_check) {
			$agency = Agency::query();
			$logged_in_user = Sentinel::getUser();
			$agency->where('agencies.owner_id', '=', $logged_in_user->id);

			
			$datatables = new Datatables;

			return $datatables->eloquent($agency)
				->editColumn('name', function ($agency) {
					return $agency->name;
				})
				->addColumn('actions', function ($agency) use ($user_check) {
					$buttons = '<a href="' . action('AgencyController@getEditAgent', array($agency->id)) . '" class="mb-sm btn btn-primary ripple" type="button" target="_blank">Edit</a> ';
					return $buttons;
				})
				->rawColumns([ 'actions'])
				->make(true);
		}
	}

	/**
	 * Gets the page to edit a user.
	 *
	 * @return Response
	 */
	public function getEditAgent($agent_id)
	{
		
		$agency = Agency::where('id',$agent_id)->get();
	 	return view('admin.agency.edit', ['agency'=>$agency,'edit_user' => true]);
		
	}
	 /**
	 * Save the agency
	 *
	 * @return Response
	 */
     public function save(Request $request)
	{
		if (!is_null(Sentinel::check())) {
			//if($userL->inRole('superadmin')){
			if (1 == 1) {

				$validator = Validator::make(Input::all(), self::$rules_add);

				$response = new \stdClass();
				$response->error = false;
				$response->errmens = [];
				$logged_in_user = Sentinel::getUser();
				if ($validator->fails()) {
					$response->error  = true;
					$response->errmens = $validator->messages();
					return RestResponse::sendResult(200, $response);
				}

				$agency = new Agency;
				$agency->name = $request->input('agency_name');
				$agency->owner_id = $logged_in_user->id;
				$agency->save();

				$response->mens = Lang::get('User successfully created.');

				return RestResponse::sendResult(200, $response);
			}
		}
	}
	 /**
	 * Save the edited agency
	 *
	 * @return Response
	 */
     public function saveEdit(Request $request)
	{
		$validator = Validator::make(Input::all(), self::$rules_add);
		
		$logged_in_user = Sentinel::getUser();
		if ($validator->fails()) {
				return response()->json([
					'status' => 'alert',
					'data' => $validator->errors()
				]);
			} 
		else{
			$agency_id = $request->input('agency_id');
			$agency = Agency::find($agency_id);
			$agency->name = $request->input('agency_name');
			$agency->save();

			return response()->json([
					'status' => 'success',
					'data' => array(
						'new_user_info' => $agency,
						'redirect' =>  action('AgencyController@getAgency') ,
						'message' => Lang::get('Agency was successfully modified.') 
					)
				]);	
		}
			
	}
}