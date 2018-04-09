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

use Sentinel;
use URL;

class AdminController extends Controller
{
    /**
     * Shows the main index page.
     *
     * @return Response
     */
    public function getIndex(Request $request)
    {
		return view('admin.index');
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
                            [ 'id' => 'type', 'label' => 'Type', 'ordenable' => true,  'searchable' => false],
                            [ 'id' => 'actions', 'label' => 'Actions', 'ordenable' => false,  'searchable' => false]
                           ];

        $param['order'] = ['order' => 1, 'way' => 'desc'];
        return view('admin.contact_importer',$param);
    }
}