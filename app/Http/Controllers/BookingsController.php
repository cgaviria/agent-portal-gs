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
use App\Traits\MonthlyRecordTrait;
use App\Library\RestResponse;

use Sentinel;
use Lang;
use URL;
use DB;
use App\Booking;
use Yajra\DataTables\DataTables;    

class BookingsController extends Controller
{
    use MonthlyRecordTrait;
    public static $rules_add = array(
        'user_id'  => 'required',
        'email'  => 'required|email',
        'refresh'  => 'required',
        'imap_host'  => 'required',
        'imap_port'  => 'required|numeric|max:999999'
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
    public function getAdminTable(Request $request)
    {
        /*https://laravel-news.com/google-api-socialite*/

        $param = array();
        $param['url']  = URL::action('BookingsController@getData');
        $param['title'] = "Booking";
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
     * Get the Admin Table
     *
     * @return Response
     */
    public function getData(Request $request)
    {
		$user_check = Sentinel::check();
		
		if ($user_check) {
			$bookings = Booking::query();

			$logged_in_user = Sentinel::getUser();
			$current_user_role = $logged_in_user->roles->first()->slug;

			if ($logged_in_user->agency_id) {
				$bookings->where('bookings.agency_id', $logged_in_user->agency_id);
			}

			$bookings->select('bookings.*');

			$bookings->leftJoin('cruise_ships', 'cruise_ships.id', '=', 'bookings.ship_id');
			if($current_user_role == "owner" && !$request->client_id){
				$bookings->leftJoin('agencies', 'agencies.id', '=', 'bookings.agency_id');
            	$bookings->where('agencies.owner_id', $logged_in_user->id);
			}
			if($current_user_role == "agency" && !$request->client_id){
				$bookings->leftJoin('users', 'users.agency_id', '=', 'bookings.agency_id');
            	$bookings->where('users.id', $logged_in_user->id);
			}
			if($current_user_role == "agent" && !$request->client_id){
				$bookings->leftJoin('users', 'users.agency_id', '=', 'bookings.agency_id');
            	$bookings->where('users.id', $logged_in_user->id) ->orWhere('bookings.agency_email_address', '=', $logged_in_user->email);
			}

            if($request->client_id){
            	$bookings->leftJoin('clients', 'clients.email', '=', 'bookings.customer_email_address');
            	$bookings->where('clients.id', $request->client_id);
            }
			if ($search_term = $request->input('search.value')) {
				$bookings->where(function($bookings) use ($search_term) {
					$bookings->where('cruise_ships.name', 'LIKE', '%' . strtolower($search_term) . '%');
					$bookings->orWhere('bookings.first_name', 'LIKE', '%' . strtolower($search_term) . '%');
					$bookings->orWhere('bookings.last_name', 'LIKE', '%' . strtolower($search_term) . '%');
					$bookings->orWhere('bookings.agency_email_address', 'LIKE', '%' . strtolower($search_term) . '%');
				});
			}

			if ($order_date_start = $request->input('order_date_start')) {
				$bookings->where('bookings.order_date', '>=', $order_date_start);
			}

			if ($order_date_end = $request->input('order_date_end')) {
				$bookings->where('bookings.order_date', '<=', $order_date_end);
			}

			if ($tour_date_start = $request->input('tour_date_start')) {
				$bookings->where('bookings.tour_date', '>=', $tour_date_start);
			}

			if ($tour_date_end = $request->input('tour_date_end')) {
				$bookings->where('bookings.tour_date', '<=', $tour_date_end);
			}
			
			$datatables = new Datatables;
			return $datatables->eloquent($bookings)
				->editColumn('first_name', function ($booking){
					return $booking->getFullName();
				})
				->editColumn('order_date', function ($booking){
					return date('m/d/Y', strtotime($booking->order_date));
				})
				->editColumn('tour_date', function ($booking){
					return date('m/d/Y', strtotime($booking->tour_date));
				})
				->editColumn('ship_id', function ($booking){
					if ($booking->ship && $booking->ship->name) {
						return $booking->ship->name;
					}

					return 'N/A';
				})
				->editColumn('cruise_start_date', function ($booking){
					return date('m/d/Y', strtotime($booking->cruise_start_date));
				})
				->addColumn('actions', function ($booking) use ($user_check){
					$buttons = '<a href="' . action('BookingsController@getBooking', array($booking->id)) . '" class="mb-sm btn btn-primary ripple" type="button" target="_blank">View</a> ';
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
	public function getBooking($id, Request $request)
	{
		$booking = Booking::find($id);

		return view('admin.booking', ['booking' => $booking]);
	}

	/**
	 * Cancels a booking.
	 *
	 * @return Response
	 */
	public function cancelBooking($id, Request $request)
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
	}
	public function getBookingMonthly(){
		$set = $this->getBookingMonthlyRecord();
        return $set;      
	}
}