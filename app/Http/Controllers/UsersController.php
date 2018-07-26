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
use App\Traits\ActivitesTrait;
use App\Library\RestResponse;

use Sentinel;
use Activation;
use Lang;
use URL;
use App\Booking;
use Yajra\DataTables\DataTables;    

class UsersController extends Controller
{
	use ActivitesTrait;
    public static $rules_add = array(
        'first_name'  => 'required|regex:/^[a-zA-Z]+$/u',
        'last_name'=>'regex:/^[a-zA-Z]+$/u',
        'email'  => 'required|email|unique:users,email',
        'password'  => 'required|confirmed|min:6',
        'password_confirmation' =>'required|min:6',
        'role'  => 'required',
        'agency_id'  => 'required_if:role,agent',
        
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
				$current_user = Sentinel::getUser();
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
				$logged_in_user  = $current_user = Sentinel::getUser();
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
				if ($user_id_to_edit = $request->input('user_id_to_edit')) {
					$this->insertActivity( url("/dashboard/users/edit/$logged_in_user->id"),'edited an existing  <a href="%a" target="_blank">User</a>',$current_user->id);
				}
				else{
					$this->insertActivity( url("/dashboard/users/my_account"),'updated own <a href="%a" target="_blank">Profile</a>',$current_user->id);
				}
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
	public function getUsers(Request $request)
	{
		$param = array();
		$logged_in_user = Sentinel::getUser();
		$current_user_role = $logged_in_user->roles->first()->slug;
		$role = Role::when($current_user_role == 'admin', function ($q) use($current_user_role) {
						return $q;
			    			//return $q->where('slug', '<>', 'admin')->where('slug','<>',$current_user_role);
						  })
					  ->when($current_user_role == 'owner', function ($q) use($current_user_role) {
			    			return $q->where('slug', '<>', 'admin')->where('slug','<>',$current_user_role);
						  })
					  ->when($current_user_role == 'agency', function ($q) use($current_user_role) {
			    			return $q->where('slug', '<>', 'admin')->where('slug', '<>', 'owner')->where('slug','<>',$current_user_role);
						  })->get();
		$agencies = Agency::when($current_user_role == 'agency', function ($q) use($logged_in_user) {
								$q->leftjoin('users', 'users.agency_id', '=', 'agencies.id');
								$q->select('agency_id as id','name');
			    			return $q->where('users.id', $logged_in_user->id);
						  		})
							->when($current_user_role == 'owner', function ($q) use($logged_in_user) {
								return $q->where('owner_id', $logged_in_user->id);
							 })
							->get();
						
		$param['roles']  = $role;
		$param['current_user_role'] = $current_user_role;
		$param['agencies']  = $agencies;
		$param['url']  = URL::action('UsersController@getData');
		$param['fields'] = [
			[ 'id' => 'photo', 'label' => 'Photo', 'ordenable' => false,  'searchable' => false,  'className' => 'dt-body-center'],
			[ 'id' => 'first_name', 'label' => 'First Name', 'ordenable' => true,  'searchable' => true],
			[ 'id' => 'last_name', 'label' => 'Last Name', 'ordenable' => true,  'searchable' => true],
			[ 'id' => 'email', 'label' => 'Email', 'ordenable' => true,  'searchable' => true],
			[ 'id' => 'role', 'label' => 'Role', 'ordenable' => true,  'searchable' => false],
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

			$users->orderBy('created_at', 'DESC');

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

					$users->leftjoin('agencies', 'agencies.id', '=', 'users.agency_id');
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
				->editColumn('photo', function ($user) {
					if ($user->photo) {
						return '<img class="users-module-image img-circle" src="' . asset(((!empty($user->image_thumbnails[\App\User::THUMB_MY_ACCOUNT])) ? $user->image_thumbnails[\App\User::THUMB_MY_ACCOUNT] : $user->photo)) . '">';
					}

					return '<span class="ion-person users-module-no-picture"></span>';
				})
				->editColumn('role', function ($user){
					$roles = array();
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
				->addColumn('actions', function ($user) use ($user_check) {
					$buttons = '<a href="' . action('UsersController@getEditUser', array($user->id)) . '" class="mb-sm btn btn-primary ripple" type="button" target="_blank">Edit</a> ';
					return $buttons;
				})
				->rawColumns(['photo', 'actions'])
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
	 /**
	 * Save the user
	 *
	 * @return Response
	 */
     public function save(Request $request)
	{
		if (!is_null(Sentinel::check())) {
			//if($userL->inRole('superadmin')){
			if (1 == 1) {

				$validator = Validator::make(Input::all(), self::$rules_add);
				$logged_in_user = Sentinel::getUser();
				$response = new \stdClass();
				$response->error = false;
				$response->errmens = [];

				if ($validator->fails()) {
					return response()->json([
						'status' => 'alert',
						'data' => $validator->errors()
					]);
				}

				$user = new User;

				$user->first_name = $request->input('first_name');
				$user->last_name = $request->input('last_name');
				$user->email = $request->input('email');
				$user->password = $request->input('password');
				$user->agency_id = $request->input('agency_id')?$request->input('agency_id'):NULL;
				$user->save();
				$insertedId = $user->id;

				$role_slug = $request->input('role');
				$role = Role::where('slug',$role_slug)->get();
				$role_id = $role[0]->id;
				$role = Role::find($role_id);
				$user->roles()->attach($role);
				
				
				$activation = Activation::create($user);
				$getactivationdata = Activation::exists($user);
				Activation::complete($user, $getactivationdata->code);
				$this->insertActivity( url("/dashboard/users/edit/$insertedId"),'added a new  <a href="%a" target="_blank">User</a>',$logged_in_user->id);
				$logged_in_user = Sentinel::getUser();

				$response->mens = Lang::get('User successfully created.');

				return RestResponse::sendResult(200, $response);
			}
		}
	}
}