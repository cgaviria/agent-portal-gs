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

use Sentinel;
use Lang;
use URL;
use App\Client;
use Yajra\DataTables\DataTables;    

class ClientsController extends Controller
{
    
    public static $rules_add = array(
        'first_name'  => 'required',
        'email'  => 'required|email',
        'ship'  => 'required',
        'sail_date'  => 'required',
        'duration' =>'required'
    );

    public static $rules_edit = array(
        'ci_id'  => 'required',
        'user_id'  => 'required',
        'email'  => 'required|email',
        'refresh'  => 'required',
        'imap_host'  => 'required',
        'imap_port'  => 'required|numeric|max:999999'
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
                            [ 'id' => 'name', 'label' => 'Name', 'ordenable' => false,  'searchable' => true],
                            [ 'id' => 'itinerary', 'label' => 'Itinerary', 'ordenable' => true,  'searchable' => true],
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
			$clients->select('clients.*');

			$datatables = new Datatables;
			return $datatables->eloquent($clients)
				->editColumn('name', function ($client){
					return $client->getFullName();
				})
				->editColumn('itinerary', function ($client){
					return $client->itinerary;
				})
				
				->addColumn('actions', function ($client) use ($user_check){
					$buttons = '<a href="' . action('ClientsController@getBooking', array($client->id)) . '" class="mb-sm btn btn-primary ripple" type="button" target="_blank">View Bookings</a> ';
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
    public function getBooking($id=NULL ,Request $request)
    {
        /*https://laravel-news.com/google-api-socialite*/
       
        $param = array();
        $param['url']  = URL::action('BookingsController@getData');
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
      if($userL){
          return view('admin.client.add')->render();
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
				$ci->itinerary = $request->input('itinerary');
				

				$ci->save();

				$response->mens = Lang::get('Client successfully created.');

				return RestResponse::sendResult(200, $response);
			}
		}
	}
	/**
	 * Cancels a booking.
	 *
	 * @return Response
	 */
	/*public function cancelBooking($id, Request $request)
	{
		$booking = Booking::find($id);

		$logged_in_user = Sentinel::getUser();

		try {
			Mail::to("christiangaviria@christiangaviria.com")->send(new CancelBooking($booking, $logged_in_user));

			return response()->json([
				'status' => 'success',
				'data' => array()
			]);
		} catch (\Exception $e) {
			return response()->json([
				'status' => 'error',
				'data' => array()
			]);
		}
	}

	public function exportCSV()
	{
		$headers = [
			'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
			'Content-type'        => 'text/csv',
			'Content-Disposition' => 'attachment; filename=bookings.csv',
			'Expires'             => '0',
			'Pragma'              => 'public'
		];

		$list = Booking::all()->toArray();

		array_unshift($list, array_keys($list[0]));

		$callback = function() use ($list)
		{
			$file_pointer = fopen('php://output', 'w');
			foreach ($list as $row) {
				fputcsv($file_pointer, $row);
			}
			fclose($file_pointer);
		};

		return Response::stream($callback, 200, $headers); //use Illuminate\Support\Facades\Response;
	}*/
}