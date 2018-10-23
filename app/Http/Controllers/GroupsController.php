<?php namespace App\Http\Controllers;

use App\Group;
use App\Http\Controllers\Controller;
use App\Ship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Traits\MonthlyRecordTrait;
use App\Library\RestResponse;

use Sentinel;
use Lang;
use URL;

use DB;
use App\Booking;
use Yajra\DataTables\DataTables;    

class GroupsController extends Controller
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
     * Shows the groups page.
     *
     * @return Response
     */
    public function getAdminTable(Request $request)
    {
        $param = array();

        $param['url'] = URL::action('GroupsController@getData');
        $param['fields'] = [
	                            [ 'id' => 'name', 'label' => 'Name', 'ordenable' => true,  'searchable' => false],
	                            [ 'id' => 'sail_date', 'label' => 'Sail Date', 'ordenable' => true,  'searchable' => false],
	                            [ 'id' => 'ship_id', 'label' => 'Ship', 'ordenable' => false,  'searchable' => false, 'width' => '10%'],
		                        [ 'id' => 'duration', 'label' => 'Duration', 'ordenable' => false,  'searchable' => false, 'width' => '10%'],
		                        [ 'id' => 'actions', 'label' => 'Actions', 'ordenable' => false,  'searchable' => false, 'width' => '10%']
							];

        $param['order'] = ['order' => 0, 'way' => 'desc'];

        return view('admin.groups', $param);
    }

    /**
     * Get the data for the Admin Table.
     *
     * @return Response
     */
    public function getData(Request $request)
    {
		$user_check = Sentinel::check();

		if ($user_check) {
			$groups = Group::query()->orderBy('id', 'DESC');

			$logged_in_user = Sentinel::getUser();

			if ($logged_in_user->agency_id) {
				$groups->select('groups.*');

				$groups->join('agencies_groups', 'agencies_groups.group_id', '=', 'groups.id');

				$groups->where('agencies_groups.agency_id', '=', $logged_in_user->agency_id);
			}

			$datatables = new Datatables;

			return $datatables->eloquent($groups)
				->editColumn('duration', function ($group){
					return $group->duration . ' days';
				})
				->editColumn('sail_date', function ($group){
					return date('m/d/Y', strtotime($group->sail_date));
				})
				->editColumn('ship_id', function ($group){
					if ($group->ship) {
						return $group->ship->name;
					}

					return 'N/A';
				})
				->addColumn('actions', function ($group) use ($user_check) {
					$buttons = '<a href="' . action('GroupsController@getGroup', array($group->id)) . '" class="mb-sm btn btn-primary ripple" type="button">View</a> ';
					$buttons.= '<a href="' . action('GroupsController@getBooking', array($group->id)) . '" class="mb-sm btn btn-primary ripple" type="button">View Booking</a> ';
					return $buttons;
				})
				->rawColumns(['actions'])
				->make(true);
		}
    }

	/**
	 * Get the page to view a group.
	 *
	 * @return Response
	 */
	public function getGroup($id, Request $request)
	{
		$group = Group::find($id);
    $agents = Booking::where('group_id',$id)
                  ->leftjoin('users','bookings.agent_id','=','users.id')
                  ->selectRaw('users.first_name,users.last_name,sum(qty_children) as qty_children,sum(qty_adult) as qty_adult,GROUP_CONCAT(DISTINCT(port)) as port,GROUP_CONCAT(DISTINCT(product_name)) as product_name,sum(qty_children+qty_adult) as total')
                  //->select('users.first_name','users.last_name','bookings.port','product_name','qty_children','qty_adult', (DB::raw('qty_children + qty_adult AS total')))
                  ->groupBy('users.id')
                  ->get();
    $count_booking = Booking::query()->where('bookings.group_id', $id)->count();

        // dd($agents);        
		return view('admin.group', ['group' => $group,'agents' => $agents,'count_booking'=>$count_booking]);
	}
	public function getGroupMonthly(){

		$set = $this->getGroupMonthlyRecord();
    return $set;   
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
        $param['group_id'] = $id;
        $param['title'] = "Bookings for Group ID ".$id;
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
    public function getCustomerGroup($url){

        $group = Group::where('url',$url)
                ->leftjoin('bookings','bookings.group_id','=','groups.id')
                ->get();
        return view('admin.customergroup', ['group' => $group]);
    
    }
}