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
use App\ContactImporter;
use Yajra\DataTables\DataTables;    

class ContactImporterController extends Controller
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

    /**
     * Get the Admin Table
     *
     * @return Response
     */
    public function getData(Request $request){

      $userL = Sentinel::check();        
      if($userL){
            
            $contactimporters = ContactImporter::query();
            $datatables = new Datatables;
            return $datatables->eloquent($contactimporters)
                  ->editColumn('refresh', function ($contactimporter) use ($userL){
                        if($contactimporter->refresh == 'auto')
                            return 'Automatic';
                        else if($contactimporter->refresh == 'daily')
                            return 'Daily';
                        else if($contactimporter->refresh == 'weekly')
                            return 'Weekly';
                        else
                            return 'Monthly';

                    })
                  ->addColumn('actions', function ($contactimporter) use ($userL){
                        $buttons = '<button class="mb-sm btn btn-primary ripple" onclick="showEditForm('.$contactimporter->id.');" type="button">Edit</button> ';
                        $buttons .= '<button class="mb-sm btn btn-primary ripple" onclick="showRunForm('.$contactimporter->id.');" type="button">Import</button> ';
                        $buttons .= '<button class="mb-sm btn btn-danger ripple" onclick="showDeleteForm('.$contactimporter->id.');" type="button">Delete</button> ';
                        return $buttons;
                    })
                  ->rawColumns(['actions'])
                  ->make(true);
          
      }  
    }

   
}