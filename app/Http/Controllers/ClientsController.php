<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\CancelBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

use App\Library\RestResponse;
use App\Traits\ActivitesTrait;

use Sentinel;
use Lang;
use URL;
use App\Client;
use App\Ship;
use Yajra\DataTables\DataTables;    

class ClientsController extends Controller
{
     use ActivitesTrait;
    public static $rules_add = array(
        'first_name'  => 'required|regex:/^[a-zA-Z]+$/u',
        'last_name'=>'regex:/^[a-zA-Z]+$/u',
        'email'  => 'required|email|unique:clients,email,$this->id,id',
        'ship'  => 'required',
        'sail_date'  => 'required',
        'duration' =>'required|numeric'
    );

    public static $rules_edit = array(
        'first_name'  => 'required|regex:/^[a-zA-Z]+$/u',
        'last_name'=>'regex:/^[a-zA-Z]+$/u',
      //  'email'  => 'required|email|unique:clients,email,$this->id,id',
        'ship'  => 'required',
        'sail_date'  => 'required',
        'duration' =>'required|numeric'
    );
    public static $rules_import = array(
        'csv_file'=>'required',
        'ship'  => 'required',
        'sail_date'  => 'required',
        'duration'  => 'required|numeric',

       
    );
    /**
     * Shows the bookings page.
     *
     * @return Response
     */
    public function getClientTable(Request $request)
    {
        /*https://laravel-news.com/google-api-socialite*/
        
        $param = array();
        $param['url']  = URL::action('ClientsController@getData');
        $param['fields'] = [
                            [ 'id' => 'first_name', 'label' => 'Name', 'ordenable' => false,  'searchable' => true],
                          
                            [ 'id' => 'email', 'label' => 'Email', 'ordenable' => true,  'searchable' => true],
                            [ 'id' => 'actions', 'label' => 'Actions', 'ordenable' => false,  'searchable' => false, 'width' => '10%']
                           ];

        $param['order'] = ['order' => 0, 'way' => 'desc'];

        return view('admin.clients', $param);
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
			$clients = Client::query();
			$logged_in_user = Sentinel::getUser();
			$current_user_role = $logged_in_user->roles->first()->slug;

			$clients->select('clients.*');
            $clients->when($current_user_role  == 'agent', function ($q) use($logged_in_user){
			    return $q->where('clients.user_id', '=', $logged_in_user->id);
			});
			$clients->when($current_user_role  == 'agency', function ($q) use($logged_in_user) {
				$q->leftjoin('users', 'clients.user_id', '=', 'users.id');
			    return $q->where('users.agency_id', '=', $logged_in_user->agency_id);
			});
			$clients->when($current_user_role  == 'owner', function ($q) use($logged_in_user) {
				$q->leftjoin('users', 'clients.user_id', '=', 'users.id');
				$q->leftjoin('agencies', 'agencies.id', '=', 'users.agency_id');
			    return $q->where('agencies.owner_id', '=', $logged_in_user->id);
			});
			
			$datatables = new Datatables;
			return $datatables->eloquent($clients)
				->editColumn('first_name', function ($client){
					return $client->getFullName();
				})
				->addColumn('actions', function ($client) use ($user_check){
					$buttons = '<a href="' . action('ClientsController@getBooking', array($client->id)) . '" class="mb-sm btn btn-primary ripple" type="button" target="_blank">View Bookings</a> ';
					 $buttons .= '<a href="' . action('ClientsController@editClient', array($client->id)) . '" class="mb-sm btn btn-primary ripple" type="button" target="_blank">Edit</a> ';
					 $buttons .= '<button class="mb-sm btn btn-danger ripple" onclick="showDeleteForm('.$client->id.');" type="button">Delete</button> ';
					return $buttons;
				})
				->rawColumns(['actions'])
				->make(true);
		}
	}

	/**
	 * Shows the booking page.
	 *
	 * @return Response
	 */
	public function getClient($id, Request $request)
	{
		$client = Client::find($id);

		return view('admin.client', ['client' => $client]);
	}
	 /**
     * Shows the bookings page.
     *
     * @return Response
     */
    public function getBooking($id ,Request $request)
    {
        /*https://laravel-news.com/google-api-socialite*/
       
        $param = array();
        $param['url']  = URL::action('BookingsController@getData');
        $param['client_id'] = $id;
        $param['title'] = "Bookings for Client ID ".$id;
        $param['fields'] = [
                            [ 'id' => 'order_id', 'label' => 'Order ID', 'ordenable' => true,  'searchable' => true],
                            [ 'id' => 'order_date', 'label' => 'Order Date', 'ordenable' => true,  'searchable' => true],
                            [ 'id' => 'first_name', 'label' => 'Full Name', 'ordenable' => true,  'searchable' => true],
	                        [ 'id' => 'customer_email_address', 'label' => 'Customer Email', 'ordenable' => true,  'searchable' => true],
                            [ 'id' => 'ship_id', 'label' => 'Cruise Ship', 'ordenable' => true,  'searchable' => false],
	                        [ 'id' => 'cruise_start_date', 'label' => 'Cruise Start Date', 'ordenable' => true,  'searchable' => false],
	                        [ 'id' => 'product_name', 'label' => 'Product Name', 'ordenable' => true,  'searchable' => true],
                            [ 'id' => 'actions', 'label' => 'Actions', 'ordenable' => false,  'searchable' => false, 'width' => '10%']
                           ];

        $param['order'] = ['order' => 0, 'way' => 'desc'];

        return view('admin.bookings', $param);
      
    }
    /**
	 * Get client add form
	 *
	 * @return Response
	 */
	public function getAddForm(Request $request){

      $userL = Sentinel::check(); 
      $ships = Ship::get(); 
      if($userL){
          return view('admin.client.add', ['ships' => $ships])->render();
      }  
    }
    /**
	 * Save the client
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
					$response->error  = true;
					$response->errmens = $validator->messages();
					return RestResponse::sendResult(200, $response);
				}

				$ci = new Client;

				$ci->first_name = $request->input('first_name');
				$ci->last_name = $request->input('last_name');
				$ci->email = $request->input('email');
				$ci->ship_id = $request->input('ship');
				$ci->sail_date = $request->input('sail_date');
				$ci->duration = $request->input('duration');
				$ci->user_id = $logged_in_user->id;
				$ci->save();

                $this->insertActivity( url("/dashboard/clients/edit/$ci->id"),'added a new  <a href="%a" target="_blank">Client</a>',$logged_in_user->id);
				$response->mens = Lang::get('Client successfully created.');

				return RestResponse::sendResult(200, $response);
			}
		}
	}
	/**
	 * Get client import form
	 *
	 * @return Response
	 */
	public function getImportCLient(Request $request){

      $userL = Sentinel::check(); 
      $ships = Ship::get(); 
      if($userL){
          return view('admin.client.import', ['ships' => $ships])->render();
      }  
    }
    /**
	 * Import clients on CSV upload
	 *
	 * @return Response
	 */
     public function import(Request $request)
	{

		if (!is_null(Sentinel::check())) {
			//if($userL->inRole('superadmin')){
			if (1 == 1) {

				$validator = Validator::make(Input::all(), self::$rules_import);
				$logged_in_user = Sentinel::getUser();
				$response = new \stdClass();
				$response->error = false;
				$response->errmens = [];

				if ($validator->fails()) {
					$response->error  = true;
					$response->errmens = $validator->messages();
					return RestResponse::sendResult(200, $response);
				}
			    $path = $request->file('csv_file')->getRealPath();
			    $customerArr = $this->csvToArray($path);
			    $file_validation = $this->csv_valid($customerArr);
			    if($file_validation){
			    	$response->error  = true;
					$response->errmens = $file_validation;
					return RestResponse::sendResult(200, $response);
				}
				else{
				    foreach ($customerArr as  $value) {
				    	$ci = new Client;
						$ci->first_name = $value['first_name'];
						$ci->last_name = $value['last_name'];
						$ci->email = $value['email'];
						$ci->ship_id = $request->input('ship');
						$ci->sail_date = $request->input('sail_date');
						$ci->duration = $request->input('duration');
						$ci->user_id = $logged_in_user->id;
					    $ci->save();
				    }
					$response->mens = Lang::get('Clients successfully created.');
					return RestResponse::sendResult(200, $response);
			  }
			}
		}
	}
	function csvToArray($filename = '', $delimiter = ',')
	{
	    if (!file_exists($filename) || !is_readable($filename))
	        return false;

	    $header = null;
	    $data = array();
	    if (($handle = fopen($filename, 'r')) !== false)
	    {
	        while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
	        {
	            if (!$header)
	                $header = $row;
	            else
	                $data[] = array_combine($header, $row);
	        }
	        fclose($handle);
	    }

	    return $data;
	}
	/**
	 * Client Delete confirmation form
	 *
	 * @return Response
	 */
	public function getDeleteForm($id){

      $userL = Sentinel::check();        
      if($userL){
        $ci = Client::find($id);
          return view('admin.client.delete',['ci'=>$ci])->render();
      }  
    }
    /**
	 * Delete functionality
	 *
	 * @return Response
	 */
    public function delete(Request $request){

      $userL = Sentinel::check();        
      if($userL){
          $response = new \stdClass();
          $response->error  = false;
          $response->errmens = [];
              
          $ci = Client::find($request -> input('ci_id'));

          $ci->delete();
          $this->insertActivity( url("/dashboard/clients/"),'deleted a client {{$ci->first_name}} {{$ci->last_name}}, see  <a href="%a" target="_blank">Clients</a>',$logged_in_user->id);
          $response->mens = Lang::get('Client successfully deleted.');
          return RestResponse::sendResult(200,$response);
      }  
    }
    public function csv_valid($data){
       
		    
		    $error = array();
		    foreach($data as $each_arr){
		    	$mail_check = Client::where('email',$each_arr['email'])->count();
			    if($each_arr['first_name'] == ""){
				    $error['first_name']=array("First name field is required.");
				    break;
			    }
			    if($each_arr['email'] == ""){
				    $error['email']=array("Email is required.");
				    break;
			    } elseif($mail_check>0){
				    $error['email']=array("There is a duplicate email that was found.");
				    break;
			    }
		    }

		    if (!empty($error)) {
			    $error['check']= array("Kindly check and upload the CSV file to import.");
		   
		}

		return  $error;
    }
     /**
	 * Delete functionality
	 *
	 * @return Response
	 */
	 public function editClient($client_id){
	 	    $ships = Ship::get();
	 	    $clients = Client::where('id',$client_id)->get();
	 		return view('admin.client.edit', ['ships'=>$ships,'clients'=>$clients,'edit_user' => true]);
	 }
	 /**
	 * Save the edit form of client
	 *
	 * @return Response
	 */
     public function saveEdit(Request $request)
	{
		$user_check = Sentinel::check();
		$validator = Validator::make(Input::all(), self::$rules_edit);
		$logged_in_user = Sentinel::getUser();
		if ($validator->fails()) {
				return response()->json([
					'status' => 'alert',
					'data' => $validator->errors()
				]);
			} 
		else{
			if ($user_check) {
				if ($request->input('user_id_to_edit')!='') {
					$user_id_to_edit = $request->input('user_id_to_edit');
					$clients = Client::find($user_id_to_edit);
					$clients->first_name = $request->input('first_name');
					$clients->last_name = $request->input('last_name');
					$clients->email = $request->input('email');
					$clients->ship_id = $request->input('ship');
					$clients->sail_date = $request->input('sail_date');
					$clients->duration = $request->input('duration');
					
					$clients->save();
					$this->insertActivity( url("/dashboard/clients/edit/$clients->id"),'edited a <a href="%a" target="_blank">Clients</a>',$logged_in_user->id);
			}
		}
		return response()->json([
				'status' => 'success',
				'data' => array(
					'new_user_info' => $clients,
					'redirect' =>  action('ClientsController@getClientTable') ,
					'message' => Lang::get('Client was successfully modified.') 
				)
			]);
		}
	}
}