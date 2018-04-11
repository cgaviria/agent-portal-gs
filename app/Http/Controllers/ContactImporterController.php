<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

use Sentinel;
use Lang;
use URL;
use App\ContactImporter;
use Yajra\DataTables\DataTables;    

class ContactImporterController extends Controller
{
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
                  ->editColumn('type', function ($contactimporter) use ($userL){
                        if($contactimporter->type == 'auto')
                            return 'Automatic';
                        else
                            return 'Manual';

                    })
                  ->addColumn('actions', function ($contactimporter) use ($userL){
                        $buttons = '<button class="mb-sm btn btn-primary ripple" type="button">Edit</button>';
                        $buttons .= '<button class="mb-sm btn btn-success ripple" type="button">Import</button>';
                        $buttons .= '<button class="mb-sm btn btn-warning ripple" type="button">Delete</button>';
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
}