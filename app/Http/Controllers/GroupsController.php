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
			$groups = Group::query();

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

		return view('admin.group', ['group' => $group]);
	}
	public function getGroupMonthly(){
		$set = $this->getGroupMonthlyRecord();
        return $set;   
	}
}