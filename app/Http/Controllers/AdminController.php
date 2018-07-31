<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Project;
use App\ProjectFile;
use App\ProjectFileTag;
use App\Repositories\ProjectFiles\ProjectFileRepository;
use App\Repositories\ProjectFileTags\ProjectFileTagsRepository;
use App\Repositories\Projects\Criteria\Search;
use App\Repositories\Projects\ProjectRepository as ProjectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

use Sentinel;
use URL;
use App\Booking;
use App\Group;
use App\Client;
use App\ContactImporter;
use App\Activities;
use App\User;

class AdminController extends Controller
{
    /**
     * Shows the main index page.
     *
     * @return Response
     */
    public function getIndex(Request $request)
    {
    	$logged_in_user = Sentinel::getUser();
    	//dd($logged_in_user);
    	
		$current_user_role = $logged_in_user->roles->first()->slug;
        $param['booking'] = Booking::count();
        $param['group'] = Group::count();
        $param['client'] = Client::count();
        $param['ContactImporter'] = ContactImporter::count();
        $param['activites_user'] = Activities::select('activities.*','users.first_name','users.last_name','users.photo')
            								   ->leftjoin('users','users.id','=','activities.user_id')
        									   ->when($current_user_role == 'agent', function ($q) use($logged_in_user)  {
														return $q->where('user_id', '=', $logged_in_user->id);
						  							})
        									    ->when($current_user_role == 'agency', function ($q) use($logged_in_user)  {
														return $q->where('agency_id', '=', $logged_in_user->agency_id);
						  							})
        									    ->when($current_user_role == 'owner', function ($q) use($logged_in_user)  {
        									    	    $q->leftjoin('agencies','agencies.id','=','users.agency_id');
        									    	    $q->where('agencies.owner_id', '=', $logged_in_user->id);
														return $q->orwhere('user_id', '=', $logged_in_user->id);
						  							})
        									    ->orderBy('activities.created_at', 'DESC')
                                                
        									    ->get();
                                                
		return view('admin.index',$param);
    }

    /**
     * Shows the login page.
     *
     * @return Response
     */
    public function getLogin(Request $request)
    {
        
        $user_login = Sentinel::check();
        if ($user_login) {
            return redirect()->route("dashboard_home");            
        }

        return view('login.index');
    }

    /**
     * Shows the contact importer page.
     *
     * @return Response
     */
    public function getContactImporter(Request $request)
    {
        /*https://laravel-news.com/google-api-socialite*/ 

        $param = array();
        $param['url']  = URL::action('ContactImporterController@getData');
        $param['fields'] = [
                            [ 'id' => 'id', 'label' => 'Id', 'ordenable' => true,  'searchable' => false],
                            [ 'id' => 'email', 'label' => 'Email', 'ordenable' => true,  'searchable' => true],
                            [ 'id' => 'refresh', 'label' => 'Import Frequency', 'ordenable' => true,  'searchable' => false],
                            [ 'id' => 'actions', 'label' => 'Actions', 'ordenable' => false,  'searchable' => false, 'width' => '10%']
                           ];

        $param['order'] = ['order' => 0, 'way' => 'desc'];
        return view('admin.contact_importer',$param);
    }
}