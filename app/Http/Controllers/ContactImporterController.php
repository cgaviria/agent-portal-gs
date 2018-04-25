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
                        $buttons .= '<button class="mb-sm btn btn-primary ripple" onclick="showRunForm();" type="button">Import</button> ';
                        $buttons .= '<button class="mb-sm btn btn-danger ripple" onclick="showDeleteForm('.$contactimporter->id.');" type="button">Delete</button> ';
                        return $buttons;
                    })
                  ->rawColumns(['actions'])
                  ->make(true);
          
      }  
    }

    public function getAddForm(Request $request){

      $userL = Sentinel::check();        
      if($userL){
          return view('admin.importer.add')->render();
      }  
    }

    public function getEditForm($id){

      $userL = Sentinel::check();        
      if($userL){
          $ci = ContactImporter::find($id);
          return view('admin.importer.edit',['ci'=>$ci])->render();
      }  
    }

    public function getDeleteForm($id){

      $userL = Sentinel::check();        
      if($userL){
        $ci = ContactImporter::find($id);
          return view('admin.importer.delete',['ci'=>$ci])->render();
      }  
    }

    public function getRunForm(Request $request){

      $userL = Sentinel::check();        
      if($userL){
          return view('admin.importer.import')->render();
      }  
    }

    public function save(Request $request){

      $userL = Sentinel::check();
        
      if(!is_null($userL)){
          //if($userL->inRole('superadmin')){
          if(1 == 1){
              if($request -> input('save_pawd') == 'y'){
                $rules_add['password'] = 'required|confirmed|min:6';
                $rules_add['password_confirmation'] = 'required|min:6'; 
              }
              $validator = Validator::make(Input::all(), self::$rules_add);
              
              $response = new \stdClass();
              $response->error  = false;
              $response->errmens = [];

              if ($validator->fails()) {
                  
                  $response->error  = true;
                  $response->errmens = $validator->messages();
                  return RestResponse::sendResult(200,$response);
              }

              
              $ci = new ContactImporter;

              $ci->email = $request -> input('email');
              $ci->password = $request -> input('password');
              $ci->refresh = $request -> input('refresh');
              $ci->imap_host = $request -> input('imap_host');
              $ci->imap_port = $request -> input('imap_port');
              $ci->save_pawd = ($request -> input('save_pawd') ? $request -> input('save_pawd') : 'n');
              $ci->user_id = $request -> input('user_id');
              
              $ci->save();

              $response->mens = Lang::get('Contact import source successfully created.');
              return RestResponse::sendResult(200,$response);
          }
      }
    }

    public function edit(Request $request){

      $userL = Sentinel::check();
        
      if(!is_null($userL)){
          //if($userL->inRole('superadmin')){
          if(1 == 1){

              if($request -> input('save_pawd') == 'y'){
                $rules_edit['password'] = 'required|confirmed|min:6';
                $rules_edit['password_confirmation'] = 'required|min:6'; 
              }
              $validator = Validator::make(Input::all(), self::$rules_edit);
              
              $response = new \stdClass();
              $response->error  = false;
              $response->errmens = [];

              if ($validator->fails()) {
                  
                  $response->error  = true;
                  $response->errmens = $validator->messages();
                  return RestResponse::sendResult(200,$response);
              }

              
              $ci = ContactImporter::find($request -> input('ci_id'));

              $ci->email = $request -> input('email');
              $ci->password = $request -> input('password');
              $ci->refresh = $request -> input('refresh');
              $ci->imap_host = $request -> input('imap_host');
              $ci->imap_port = $request -> input('imap_port');
              $ci->save_pawd = ($request -> input('save_pawd') ? $request -> input('save_pawd') : 'n');
              
              $ci->save();

              $response->mens = Lang::get('Contact import source successfully modified.');
              return RestResponse::sendResult(200,$response);
          }
      }
    }

    public function delete(Request $request){

      $userL = Sentinel::check();        
      if($userL){
          $response = new \stdClass();
          $response->error  = false;
          $response->errmens = [];
              
          $ci = ContactImporter::find($request -> input('ci_id'));
          $ci->delete();

          $response->mens = Lang::get('Contact import source successfully deleted.');
          return RestResponse::sendResult(200,$response);
      }  
    }
}