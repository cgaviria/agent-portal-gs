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
                        $buttons = ' <button class="mt-sm btn btn-labeled btn-default ripple" type="button">Edit<span class="btn-label btn-label-right"><i class="ion-plus-round"></i></span></button><button class="mt-sm btn btn-labeled btn-default ripple" type="button">Delete<span class="btn-label btn-label-right"><i class="ion-plus-round"></i></span></button>';
                        return $buttons;
                    })
                  ->rawColumns(['actions'])
                  ->filter(function ($query) use ($request) {
                        
                    })
                  ->make(true);
          
      }  
    }

   
}