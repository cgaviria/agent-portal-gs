<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\CancelBooking;
use App\Role;
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
			if ($user_id_to_edit = $request->input('user_id_to_edit')) {
				$logged_in_user = Sentinel::findById($user_id_to_edit);

				$users = User::query();

				$user = Sentinel::getUser();

				$users->where('users.id', '!=', $user->id);
				$users->where('users.id', $logged_in_user->id);

				if (!Sentinel::inRole(Role::ROLE_ADMIN)) {
					if ($logged_in_user->agency_id && Sentinel::inRole(Role::ROLE_AGENCY_MANAGER)) {
						$agent_role = Sentinel::findRoleBySlug(Role::ROLE_AGENT);

						$users->select('users.*');

						$users->join('role_users', 'role_users.user_id', '=', 'users.id');

						$users->where('users.agency_id', $logged_in_user->agency_id);
						$users->where('role_users.role_id', $agent_role->id);
					} else if (Sentinel::inRole(Role::ROLE_OWNER)) {
						$agent_role = Sentinel::findRoleBySlug(Role::ROLE_AGENT);
						$agency_manager_role = Sentinel::findRoleBySlug(Role::ROLE_AGENCY_MANAGER);

						$users->select('users.*');

						$users->join('agencies', 'agencies.id', '=', 'users.agency_id');
						$users->join('role_users', 'role_users.user_id', '=', 'users.id');

						$users->where('agencies.owner_id', $logged_in_user->id);
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
						'redirect' => action('AdminController@getIndex'),
						'message' => Lang::get('Your account was successfully modified.')
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
	public function getUsers(Request $request)
	{
		$param = array();
		$param['url']  = URL::action('UsersController@getData');
		$param['fields'] = [
			[ 'id' => 'first_name', 'label' => 'First Name', 'ordenable' => true,  'searchable' => true],
			[ 'id' => 'last_name', 'label' => 'Last Name', 'ordenable' => true,  'searchable' => true],
			[ 'id' => 'email', 'label' => 'Email', 'ordenable' => true,  'searchable' => true],
			[ 'id' => 'role', 'label' => 'Role', 'ordenable' => true,  'searchable' => true],
			[ 'id' => 'agency_id', 'label' => 'Agency', 'ordenable' => true,  'searchable' => false],
			[ 'id' => 'actions', 'label' => 'Actions', 'ordenable' => false,  'searchable' => false, 'width' => '10%']
		];

		$param['order'] = ['order' => 0, 'way' => 'desc'];

		return view('admin.users', ['datatables_params' => $param]);
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
			$users = User::query();

			$logged_in_user = Sentinel::getUser();

			$users->where('users.id', '!=', $logged_in_user->id);

			if (!Sentinel::inRole(Role::ROLE_ADMIN)) {
				if ($logged_in_user->agency_id && Sentinel::inRole(Role::ROLE_AGENCY_MANAGER)) {
					$agent_role = Sentinel::findRoleBySlug(Role::ROLE_AGENT);

					$users->select('users.*');

					$users->join('role_users', 'role_users.user_id', '=', 'users.id');

					$users->where('users.agency_id', $logged_in_user->agency_id);
					$users->where('role_users.role_id', $agent_role->id);
				} else if (Sentinel::inRole(Role::ROLE_OWNER)) {
					$agent_role = Sentinel::findRoleBySlug(Role::ROLE_AGENT);
					$agency_manager_role = Sentinel::findRoleBySlug(Role::ROLE_AGENCY_MANAGER);

					$users->select('users.*');

					$users->join('agencies', 'agencies.id', '=', 'users.agency_id');
					$users->join('role_users', 'role_users.user_id', '=', 'users.id');

					$users->where('agencies.owner_id', $logged_in_user->id);
					$users->whereNotNull('users.agency_id');

					$users->where(function($users) use ($agent_role, $agency_manager_role) {
						$users->where('role_users.role_id', $agent_role->id);
						$users->orWhere('role_users.role_id', $agency_manager_role->id);
					});
				} else {
					$users->limit(0);
				}
			}

			$datatables = new Datatables;

			return $datatables->eloquent($users)
				->editColumn('role', function ($user){
					foreach (Sentinel::findById($user->id)->roles as $role) {
						$roles[] = $role->name;
					}

					return implode($roles, ', ');
				})
				->editColumn('agency_id', function ($user){
					if ($user->agency_id && ($user->inRole(Role::ROLE_AGENT) || $user->inRole(Role::ROLE_AGENCY_MANAGER))) {
						return $user->agency->name;
					} else {
						return 'N/A';
					}
				})
				->addColumn('actions', function ($user) use ($user_check){
					$buttons = '<a href="' . action('UsersController@getEditUser', array($user->id)) . '" class="mb-sm btn btn-primary ripple" type="button" target="_blank">View</a> ';
					return $buttons;
				})
				->rawColumns(['actions'])
				->make(true);
		}
	}

	/**
	 * Gets the page to edit a user.
	 *
	 * @return Response
	 */
	public function getEditUser($user_id)
	{
		$user_to_edit = Sentinel::findById($user_id);

		return view('admin.my_account', ['logged_in_user' => $user_to_edit,
											'edit_user' => true]);
	}
}