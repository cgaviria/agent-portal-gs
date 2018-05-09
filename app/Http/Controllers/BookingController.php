<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

use App\Library\RestResponse;

use Sentinel;
use Lang;
use URL;
use App\Booking;
use Yajra\DataTables\DataTables;    

class BookingController extends Controller
{
    
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
     * Shows the booking page.
     *
     * @return Response
     */
    public function getAdminTable(Request $request)
    {
        /*https://laravel-news.com/google-api-socialite*/ 

        $param = array();
        $param['url']  = URL::action('BookingController@getData');
        $param['fields'] = [
                            [ 'id' => 'booking_number', 'label' => 'Booking Number', 'ordenable' => true,  'searchable' => false],
                            [ 'id' => 'name', 'label' => 'Name', 'ordenable' => true,  'searchable' => true],
                            [ 'id' => 'sail_date', 'label' => 'Sail Date', 'ordenable' => true,  'searchable' => false],
                            [ 'id' => 'ship_id', 'label' => 'Ship', 'ordenable' => true,  'searchable' => false],
                            [ 'id' => 'actions', 'label' => 'Actions', 'ordenable' => false,  'searchable' => false, 'width' => '10%']
                           ];

        $param['order'] = ['order' => 0, 'way' => 'desc'];
        return view('admin.bookings',$param);
    }

    /**
     * Get the Admin Table
     *
     * @return Response
     */
    public function getData(Request $request){

      $userL = Sentinel::check();        
      if($userL){
            
            $bookings = Booking::query();
            $datatables = new Datatables;
            return $datatables->eloquent($bookings)
                  ->editColumn('name', function ($booking){
                            return $booking->getFullName();
                    })
                  ->editColumn('ship_id', function ($booking){
                            return $booking->ship->name;
                    })
                  ->addColumn('actions', function ($booking) use ($userL){
                        $buttons = '<button class="mb-sm btn btn-primary ripple" onclick="showEditForm('.$booking->id.');" type="button">Edit</button> ';
                        $buttons .= '<button class="mb-sm btn btn-danger ripple" onclick="showDeleteForm('.$booking->id.');" type="button">Delete</button> ';
                        return $buttons;
                    })
                  ->rawColumns(['actions'])
                  ->make(true);
          
      }  
    }

   
}