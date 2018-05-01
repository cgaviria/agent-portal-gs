<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

use App\Import;
use App\ImportedBooking;
use App\ContactBooking;
use App\ContactImporter;

use App\Library\RestResponse;

use Webklex\IMAP\Client;
use App\Library\TravelerLeadersBusiness;

class ImapController extends BaseController{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static $rules = array(
        'password'  => 'required|confirmed',
        'password_confirmation'  => 'required'
    );

	public function makeImportNoPaswd(Request $request){

		$response = new \stdClass();
      	$response->error  = false;
      	$response->errmens = [];

      	$validator = Validator::make(Input::all(), self::$rules);

		$response = new \stdClass();
		$response->error = false;
		$response->errmens = [];

		if ($validator->fails()) {
			$response->error  = true;
			$response->errmens = $validator->messages();
			return RestResponse::sendResult(200, $response);
		}

		$importer = ContactImporter::find($request->input('importer_id'));
		$importer->password = $request->input("password");

		return $this->executeImport($importer);
    	
    }    

    public function makeImportPaswd(Request $request){

    	$importer = ContactImporter::find($request->input('importer_id'));

    	return $this->executeImport($importer);
    }

    public function executeImport(ContactImporter $importer){

    	$response = new \stdClass();
      	$response->error  = false;
      	$response->errmens = [];

    	$last_import = Import::where('importer_id',"=",$importer->id)->orderBy('created_at')->first();
    	if($last_import){
    		if($last_import->state == "running"){
    			$response->error  = true;
            	$response->errmens = ['error'=>['There a process running at the moment, please wait this process end.']];
            	return RestResponse::sendResult(200,$response);
    		}
    	}

    	$import = new Import;
    	$import->importer_id = $importer->id;
    	$import->state = "nostate";
    	$import->num_imports = 0;
    	$import->save();

    	$oClient = new Client([
		    'host'          => $importer->imap_host,
		    'port'          => $importer->imap_port,
		    'encryption'    => 'ssl',
		    'validate_cert' => true,
		    'username'      => $importer->email,
		    'password'      => $importer->password,
		]);

		try{
			$oClient->connect();
			$aFolder = $oClient->getFolders();
			
			$import->state = "running";
    		$import->save();
			
			foreach($aFolder as $oFolder){
				
				$filters = [['FROM', 'cgaviria@shoreex.com']];
				if($last_import){
					$filters[] = ['SINCE', strtotime($last_import->created_at)];
				}
				
				$aMessage = $oFolder->searchMessages($filters);
				$num = 0;
				foreach($aMessage as $oMessage){
			        /*echo $oMessage->subject.'<br />';
			        echo 'Attachments: '.$oMessage->getAttachments()->count().'<br />';
			        echo $oMessage->getHTMLBody(true);*/
					$data_export = TravelerLeadersBusiness::parseEmail($oMessage->getTextBody());
					$passengers = TravelerLeadersBusiness::findContacts($data_export);

					$im = new ImportedBooking;
					$im->user_id = $importer->User->id;
					$im->contact_importer_id = $importer->id;
					$im->info = json_encode($data_export);
					$im->save();

					foreach ($passengers as $pa) {
						$p = new ContactBooking;
						$p->name = $pa->name;
						$p->citizenship = $pa->citizenship;
						$p->birth = date('Y-m-d',strtotime($pa->birth));
						$p->email = $pa->email;
						$p->booking_id = $im->id;
						$p->save();
					}
					$num++;
					$import->num_imports = $num;
					$import->save();
			    }
			}

			$import->state = "finish";
    		$import->save();

    		$response->mens = "Import process was finish successfully";
            return RestResponse::sendResult(200,$response);
			
		}catch(\Exception $e){
			$response->error  = true;
            $response->errmens = ['error'=>[$e->getMessage()]];
            return RestResponse::sendResult(200,$response);
		}
    }
}