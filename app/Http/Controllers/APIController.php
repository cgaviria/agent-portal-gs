<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use App\Agency; 
use App\Booking; 
use App\SysVariables;
use App\ApiTokens; 
use \App\Group;
use Illuminate\Support\Facades\Auth; 
use Validator;
use Sentinel;
use DB;

class APIController extends Controller
{
  
public $successStatus = 200;

/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(Request $request){ 
       
        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];
        $data = Sentinel::authenticate($credentials);
        //$agency_api_key = $this->getApiKey($request,$data->id); // Get the api key associated with the user
        //$user_api_key = $this->getUserApiKey($request,$data->id); 
        $agency_api_key = $request->agency_api_key?$request->agency_api_key:'';
        $user_api_key = $request->user_api_key;
        $current_time = time();
        $valid_till = $current_time + 60*60*2;
        $token = "";
        if($data){ 
            if(Sentinel::findById($data->id)->roles[0]->slug == "admin"){
                $token =   base64_encode($data->id.'/'.md5($data->id.'/'.$request->email.'/'.md5($data->password).'/'.$valid_till).'/'.$valid_till.'/'.md5($user_api_key));
            }
            else if($agency_api_key){ 
                $token =   base64_encode($data->id.'/'.md5($data->id.'/'.$request->email.'/'.md5($data->password).'/'.$valid_till).'/'.$valid_till.'/'.md5($user_api_key).'/'.md5($agency_api_key));
               //$token =   base64_encode($data->id.'/'.md5($data->id.'/'.$request->email.'/'.md5($data->password).'/'.$agency_api_key.'/'.$valid_till).'/'.$valid_till);   // Generate the token with id,email,password,apikey,valid_till data
            } 
            if($token){
                $apitoken = new ApiTokens;
                $success['token'] = $token;
                $apitoken->token_string = substr($token,0,8);
                $apitoken->user_id = $data->id;
                $apitoken->unix_timestamp = $current_time;
                $apitoken->valid_until = $valid_till;
                $apitoken->save();
                return response()->json(['success' => $success,'data'=>$data], $this-> successStatus); 
            }
            else{ 
                return response()->json(['error'=>'Unauthorised'], 401); 
            }
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401); 
        }
    }

    public function create_booking(Request $request){
        
        $input = $request->all();
        $token_array = $this->getToken($request); // Get the token passed through header
        $checkAuthentication = $this->checkAuthentication($token_array); // Check  authentication.
        //$agency_id = $this->getAgencyId($token_array);
        $user_id = $token_array[0];
        $userRole = DB::table('users')
                  ->leftJoin('role_users', 'users.id', '=', 'role_users.user_id')
                  ->where('user_id',$user_id)
                  ->select('role_id')
                  ->get();
        if($userRole[0]->role_id == 1){
            $error = $this->permissionAgent($token_array,$input);
        }
        if($userRole[0]->role_id == 2){
            $error = $this->permissionAgency($token_array,$input);
        }
        if($userRole[0]->role_id == 3){
            $error = $this->permissionOwner($token_array,$input);
        }
         if($userRole[0]->role_id == 4){
            $error = $this->permissionAdmin();
        }
       
        if($checkAuthentication && $error == 0){
                $booking = new Booking(array(
                        'order_id' =>$input['order_id'],
                        'order_date' => $input['order_date'],
                        'order_status' => $input['order_status'],
                        'order_notes' => $input['order_notes'],
                        'payment_received' => $input['payment_received'],
                        'paymentAmount' => $input['paymentAmount'],
                        'customer_phone_number' => $input['customer_phone_number'],
                        'customer_email_address' => $input['customer_email_address'],
                        'customer_email_sent' => $input['customer_email_sent'],
                        'first_name' => $input['first_name'],
                        'last_name' => $input['last_name'],
                        'agency_data' => $input['agency_data'],
                        'agency_email_address' => $input['agency_email_address'],
                        'agency_name' => $input['agency_name'],
                        'agency_branding' => $input['agency_branding'],
                        'agency_bcc' => $input['agency_bcc'],
                        'review_email_disabled' => $input['review_email_disabled'],
                        'ship_id' => $input['ship_id'],
                        'cruise_start_date' => $input['cruise_start_date'],
                        'cruise_duration' => $input['cruise_duration'],
                        'customer_notes' => $input['customer_notes'],
                        'notes_to_vendor' => $input['notes_to_vendor'],
                        'accounting_notes' => $input['accounting_notes'],
                        'hold_emails_for_tour' => $input['hold_emails_for_tour'],
                        'product_code' => $input['product_code'],
                        'product_name' => $input['product_name'],
                        'options_list' => $input['options_list'],
                        'qty_adult' => $input['qty_adult'],
                        'qty_children' => $input['qty_children'],
                        'quantity' => $input['quantity'],
                        'discount_row' => $input['discount_row'],
                        'total_price' => $input['total_price'],
                        'affiliate_payment' => $input['affiliate_payment'],
                        'total_vendor_cost' => $input['total_vendor_cost'],
                        'auto_confirm' => $input['auto_confirm'],
                        'over_ride' => $input['over_ride'],
                        'itinerary_works' => $input['itinerary_works'],
                        'tour_date' => $input['tour_date'],
                        'tour_time' => $input['tour_time'],
                        'tour_duration' => $input['tour_duration'],
                        'buffer_time' => $input['buffer_time'],
                        'vendor_title' => $input['vendor_title'],
                        'vendor_currency' => $input['vendor_currency'],
                        'port' => $input['port'],
                        'port_arrival' => $input['port_arrival'],
                        'port_departure' => $input['port_departure'],
                        'agent_id'=> $input['agent_id']
                        
                    ));
                $booking_insert =  $booking->save();
                if($booking){
                    return response()->json(['return_type' => 'success','data'=>$booking], $this-> successStatus); 
                } 
                else{ 
                    return response()->json(['error'=>'Error while creating booking'], 401); 
                } 
        }
        else{ 
                return response()->json(['error'=>'Unauthorised'], 401); 
            } 
    }
   
     public function edit_booking(Request $request){
        $input = $request->all();
        $token_array = $this->getToken($request);  // Get the token passed through header
        $checkAuthentication = $this->checkAuthentication($token_array); // Check  authentication.
        $user_id = $token_array[0];
        $userRole = DB::table('users')
                  ->leftJoin('role_users', 'users.id', '=', 'role_users.user_id')
                  ->where('user_id',$user_id)
                  ->select('role_id')
                  ->get();
        if($userRole[0]->role_id == 1){
            $error = $this->permissionAgent($token_array,$input);
        }
        if($userRole[0]->role_id == 2){
            $error = $this->permissionAgency($token_array,$input);
        }
        if($userRole[0]->role_id == 3){
            $error = $this->permissionOwner($token_array,$input);
        }
        if($userRole[0]->role_id == 4){
            $error = $this->permissionAdmin();
        }
        if($checkAuthentication  && $error == 0){
            $booking = Booking::find($input['id']);
            $booking->order_id = $input['order_id'];
            $booking->order_date = $input['order_date'];
            $booking->order_status = $input['order_status'];
            $booking->order_notes = $input['order_notes'];
            $booking->payment_received = $input['payment_received'];
            $booking->payment_amount = $input['paymentAmount'];
            $booking->customer_phone_number = $input['customer_phone_number'];
            $booking->customer_email_address = $input['customer_email_address'];
            $booking->customer_email_sent = $input['customer_email_sent'];
            $booking->first_name = $input['first_name'];
            $booking->last_name = $input['last_name'];
            $booking->agency_data = $input['agency_data'];
            $booking->agency_email_address = $input['agency_email_address'];
            $booking->agency_name = $input['agency_name'];
            $booking->agency_branding = $input['agency_branding'];
            $booking->agency_bcc = $input['agency_bcc'];
            $booking->review_email_disabled = $input['review_email_disabled'];
            $booking->ship_id = $input['ship_id'];
            $booking->cruise_start_date = $input['cruise_start_date'];
            $booking->cruise_duration = $input['cruise_duration'];
            $booking->customer_notes = $input['customer_notes'];
            $booking->notes_to_vendor = $input['notes_to_vendor'];
            $booking->accounting_notes = $input['accounting_notes'];
            $booking->hold_emails_for_tour = $input['hold_emails_for_tour'];
            $booking->product_code = $input['product_code'];
            $booking->product_name = $input['product_name'];
            $booking->options_list = $input['options_list'];
            $booking->qty_adult = $input['qty_adult'];
            $booking->qty_children = $input['qty_children'];
            $booking->quantity = $input['quantity'];
            $booking->discount_row = $input['discount_row'];
            $booking->total_price = $input['total_price'];
            $booking->affiliate_payment = $input['affiliate_payment'];
            $booking->total_vendor_cost = $input['total_vendor_cost'];
            $booking->auto_confirm = $input['auto_confirm'];
            $booking->over_ride = $input['over_ride'];
            $booking->itinerary_works = $input['itinerary_works'];
            $booking->tour_date = $input['tour_date'];
            $booking->tour_time = $input['tour_time'];
            $booking->tour_duration = $input['tour_duration'];
            $booking->buffer_time = $input['buffer_time'];
            $booking->vendor_title = $input['vendor_title'];
            $booking->vendor_currency = $input['vendor_currency'];
            $booking->port = $input['port'];
            $booking->port_arrival = $input['port_arrival'];
            $booking->port_departure = $input['port_departure'];
            $booking->agent_id=$input['agent_id'];

            $booking_update =  $booking->save();
            if($booking_update){
                return response()->json(['return_type' => 'success','data'=>$booking], $this-> successStatus); 
            } 
            else{ 
                return response()->json(['error'=>'Booking editing is not successful'], 401); 
            } 
        }
        else{ 
                return response()->json(['error'=>'Unauthorised'], 401); 
            } 
     }
     public function read_booking(Request $request){
       $input = $request->all();
       $token_array = $this->getToken($request); // Get the token passed through header
       $checkAuthentication = $this->checkAuthentication($token_array); // Check  authentication.
       $user_id = $token_array[0];
       $userRole = DB::table('users')
                  ->leftJoin('role_users', 'users.id', '=', 'role_users.user_id')
                  ->where('user_id',$user_id)
                  ->select('role_id')
                  ->get();
        if($userRole[0]->role_id == 1){
            $error = $this->permissionAgentForReadBooking($token_array,$input);
        }
        if($userRole[0]->role_id == 2){
            $error = $this->permissionAgencyForReadBooking($token_array,$input);
        }
        if($userRole[0]->role_id == 3){
            $error = $this->permissionOwnerForReadBooking($token_array,$input);
        }
        if($userRole[0]->role_id == 4){
            $error = $this->permissionAdminForReadBooking();
        }
       if($checkAuthentication && $error == 0){
           $booking = Booking::find($input['id']);
           if($booking){
                return response()->json(['return_type' => 'success','data'=>$booking], $this-> successStatus); 
            } 
            else{ 
                return response()->json(['error'=>'Error in getting records'], 401); 
            }
        } 
        else{ 
                return response()->json(['error'=>'Unauthorised'], 401); 
            }
    }
    public function delete_booking(Request $request){
       $input = $request->all();
       $token_array = $this->getToken($request); // Get the token passed through header
       $checkAuthentication = $this->checkAuthentication($token_array); // Check  authentication.
       $user_id = $token_array[0];
       $userRole = DB::table('users')
                  ->leftJoin('role_users', 'users.id', '=', 'role_users.user_id')
                  ->where('user_id',$user_id)
                  ->select('role_id')
                  ->get();
        if($userRole[0]->role_id == 1){
            $error = $this->permissionAgentForReadBooking($token_array,$input);
        }
        if($userRole[0]->role_id == 2){
            $error = $this->permissionAgencyForReadBooking($token_array,$input);
        }
        if($userRole[0]->role_id == 3){
            $error = $this->permissionOwnerForReadBooking($token_array,$input);
        }
        if($userRole[0]->role_id == 4){
            $error = $this->permissionAdminForReadBooking();
        }
       if($checkAuthentication && $error == 0){
           $booking = Booking::find($input['id']);
           $booking_del =  $booking?$booking->delete():'';
           if($booking_del){
                return response()->json(['return_type' => 'success','data'=>$booking], $this-> successStatus); 
            } 
            else{ 
                return response()->json(['error'=>'Delete booking cant be performed'], 401); 
            }
        } 
        else{ 
                return response()->json(['error'=>'Unauthorised'], 401); 
            }
    }
    public function create_group(Request $request){
        $input = $request->all();
        $token_array = $this->getToken($request); // Get the token passed through header
        $checkAuthentication = $this->checkAuthentication($token_array); // Check  authentication.
        if($checkAuthentication){
            $group = new \App\Group(array(
                    'name' => $input['name'],
                    'url' => $input['url'],
                    'email' => $input['email'],
                    'ship_id' => $input['ship_id'],
                    'sail_date' => $input['sail_date'],
                    'duration' => $input['duration'],
                    'text' => $input['text'],
                    'image' => $input['image'],
                    
                ));

            $group_insert =  $group->save();
            if($group_insert){
                return response()->json(['return_type' => 'success','data'=>$group], $this-> successStatus); 
            } 
            else{ 
                return response()->json(['error'=>'Group creation is not performed'], 401); 
            } 
        }
        else{ 
                return response()->json(['error'=>'Unauthorised'], 401); 
            } 
    }
    public function edit_group(Request $request){
        $input = $request->all();
        $token_array = $this->getToken($request); // Get the token passed through header
        $checkAuthentication = $this->checkAuthentication($token_array); // Check  authentication.
        if($checkAuthentication){
            $group = Group::find($input['id']);
            $group->name = $input['name'];
            $group->url = $input['url'];
            $group->email = $input['email'];
            $group->ship_id = $input['ship_id'];
            $group->sail_date = $input['sail_date'];
            $group->duration = $input['duration'];
            $group->text = $input['text'];
            $group->image = $input['image'];
                    
            $group_update =  $group->save();
            if($group_update){
                return response()->json(['return_type' => 'success','data'=>$group], $this-> successStatus); 
            } 
            else{ 
                return response()->json(['error'=>'Edit group is not successful'], 401); 
            }
        } 
        else{ 
                return response()->json(['error'=>'Unauthorised'], 401); 
            }
    }
    public function read_group(Request $request){
       
       $input = $request->all();
       $token_array = $this->getToken($request); // Get the token passed through header
       $checkAuthentication = $this->checkAuthentication($token_array); // Check  authentication.
       if($checkAuthentication){
           $group = Group::find($input['id']);
           if($group){
                return response()->json(['return_type' => 'success','data'=>$group], $this-> successStatus); 
            } 
            else{ 
                return response()->json(['error'=>'No data found'], 401); 
            } 
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
     public function delete_group(Request $request){
       $input = $request->all();
       $token_array = $this->getToken($request); // Get the token passed through header
       $checkAuthentication = $this->checkAuthentication($token_array); // Check  authentication.
       if($checkAuthentication){
           $group = Group::find($input['id']);
           $group_del =  $group?$group->delete():'';
           if($group_del){
                return response()->json(['return_type' => 'success','data'=>$group], $this-> successStatus); 
            } 
            else{ 
                return response()->json(['error'=>'Unauthorised'], 401); 
            } 
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
    private function getToken(Request $request){

        $token = $request->header('token');
        $tokenstring = base64_decode($token);
        $array = explode('/',$tokenstring);
        return $array;
    }
    private function checkAuthentication($token_array){

        //$token =   base64_encode($data->id.'/'.md5($data->id.'/'.$request->email.'/'.md5($data->password).'/'.$valid_till).'/'.$valid_till.'/'.md5($user_api_key).'/'.md5($agency_api_key));

        $user_id = $token_array[0];
        $api_key_gen = $token_array[1];
        $valid_till = $token_array[2];
        $user_api_key = $token_array[3];
        $agency_api_key = count($token_array)>4?$token_array[4]:'';
       
        $current_time = time();
        $user = User::where('id',$user_id)->get();
        if($agency_api_key)
            $agency_key = $this->getApiKey($user[0],$user[0]->id); // Get the agency api key associated with the user
        $user_api = $this->getUserApiKey($user[0],$user[0]->id); // Get the api key associated with the user
        $token =   md5($user[0]->id.'/'.$user[0]->email.'/'.md5($user[0]->password).'/'.$valid_till); //rebuild of md5 token
       
        if($user_id == 1){
            if($token == $api_key_gen  && $user_api_key == md5($user_api) ){ 
                if($current_time <= $valid_till) // check if current time is less than valid till time.
                   return true;
                else
                    return false;
            }
        }
        else {
            if($token == $api_key_gen && $agency_api_key == md5($agency_key) && $user_api_key == md5($user_api) ){ 
                if($current_time <= $valid_till) // check if current time is less than valid till time.
                   return true;
                else
                    return false;
            }
        }
    }
    /*private function getAgencyId($token_array){
        $user_id = $token_array[0];
        $api_key_gen = $token_array[1];
        $valid_till = $token_array[2];
        $user_api_key = $token_array[3];
        $user = User::where('id',$user_id)->get();
        if($user_id == 1){
            $agency_api_key = '';
            $agency_id = 1;
        }
        else{
            $agency_api_key = $token_array[4];
            $agency_id = $this->getIdAgency($user[0],$agency_api_key);
        }
        return $agency_id;
    }*/
    private function getApiKey($request,$user_id){
        
        $api_key = '';
        $userApi = User::where('email',$request->email)->leftjoin('agencies','users.agency_id','=','agencies.id')->select('agencies.*')->get();
        $ownerApi = User::where('email',$request->email)->leftjoin('agencies','users.id','=','agencies.owner_id')->select('agencies.*')->get();
        /*if(Sentinel::findById($user_id )->roles[0]->slug == "admin"){
            $adminApi = SysVariables::select('value')->where('key','ADMIN_APIKEY')->get();
            $api_key = $adminApi[0]->value;
        }*/
        if($userApi[0]->api_key)
          $api_key = $userApi[0]->api_key;
        else if( $ownerApi[0]->api_key)
          $api_key = $ownerApi[0]->api_key;
        return $api_key;
    }
     private function getUserApiKey($request,$user_id){
        
        $api_key = '';
        $userApi = User::where('email',$request->email)->select('users.*')->get();
        /*if(Sentinel::findById($user_id )->roles[0]->slug == "admin"){
            $adminApi = SysVariables::select('value')->where('key','ADMIN_APIKEY')->get();
            $api_key = $adminApi[0]->value;
        }*/
        if($userApi[0]->api_key)
          $api_key = $userApi[0]->api_key;
        return $api_key;
    }
   /* private function getIdAgency($request,$agency_api_key){
        $userApi = User::where('email',$request->email)->leftjoin('agencies','users.agency_id','=','agencies.id')->select('agencies.*')->get();
        $ownerApi = User::where('email',$request->email)->leftjoin('agencies','users.id','=','agencies.owner_id')->select('agencies.*')->get();
        if($userApi[0]->api_key)
          $agency_id = $userApi[0]->id;
        else if( $ownerApi[0]->api_key)
          $agency_id = $ownerApi[0]->id;
        return $agency_id;
        //return  $userApi[0]->id;
    }*/
    
    private function permissionAgent($token_array,$input){
        $user_id = $token_array[0];
        $api_key_gen = $token_array[1];
        $valid_till = $token_array[2];
        $user_api_key = $token_array[3];
        $agency_api_key = count($token_array)>4?$token_array[4]:'';
        $user = User::where('id',$user_id)->get();
        $error = 0;
        $userApi = User::where('email',$user[0]->email)->leftjoin('agencies','users.agency_id','=','agencies.id')->select('agencies.*')->get();
        $agency_id = $userApi[0]->id;
        $agency_name = $userApi[0]->name;
        $agent_id = $input['agent_id'];
        $agency_name_ip = $input['agency_name'];
        if($user_id != $agent_id){
            $error = 1;
        }
        if($agency_name != $agency_name_ip){
            $error = 1;
        }
        return $error;
    }
    private function permissionAgency($token_array,$input){
        $user_id = $token_array[0];
        $api_key_gen = $token_array[1];
        $valid_till = $token_array[2];
        $user_api_key = $token_array[3];
        $agency_api_key = count($token_array)>4?$token_array[4]:'';
        $user = User::where('id',$user_id)->get();
        $error = 0;
        $userApi = User::where('email',$user[0]->email)->leftjoin('agencies','users.agency_id','=','agencies.id')->select('agencies.*')->get();
        $agency_id = $userApi[0]->id;
        $agency_name = $userApi[0]->name;
        $agent_id = $input['agent_id'];
        $agency_name_ip = $input['agency_name'];
        $agentBelongsTo = User::where('users.id',$agent_id)->leftjoin('agencies','users.agency_id','=','agencies.id')->where('agencies.id',$agency_id)->select('agencies.*')->get();
        if(!$agentBelongsTo){
            $error = 1;
        }
        if($agency_name != $agency_name_ip){
            $error = 1;
        }
        return $error;
    }
    private function permissionOwner($token_array,$input){
        $user_id = $token_array[0];
        $api_key_gen = $token_array[1];
        $valid_till = $token_array[2];
        $user_api_key = $token_array[3];
        $agency_api_key = $token_array[4];
        $user = User::where('id',$user_id)->get();
        $error = 0;
        $userApi = User::where('email',$user[0]->email)->leftjoin('agencies','users.id','=','agencies.owner_id')->select('agencies.*')->get();
        $agency_id = $userApi[0]->id;
        $agency_name = $userApi[0]->name;
        $agent_id = $input['agent_id'];
        $agency_name_ip = $input['agency_name'];
        $agentBelongsTo = User::where('users.id',$agent_id)->leftjoin('agencies','users.agency_id','=','agencies.id')->where('agencies.id',$agency_id)->select('agencies.*')->get();
        if(!$agentBelongsTo){
            $error = 1;
        }
        if($agency_name != $agency_name_ip){
            $error = 1;
        }
        return $error;
    }
    private function permissionAdmin(){
        $error = 0;
        return $error;
    }
     private function permissionAgentForReadBooking($token_array,$input){
        $user_id = $token_array[0];
        $error = 0;
        $booking_id = $input['id'];
        $bookingApi = Booking::where('id',$booking_id)->get();
        $agent_id_booking = $bookingApi[0]->agent_id;
        
        if($user_id != $agent_id_booking){
            $error = 1;
        }
        
        return $error;
    }
    private function permissionAgencyForReadBooking($token_array,$input){
        $user_id = $token_array[0];
        $user = User::where('id',$user_id)->get();
        $error = 0;
        $userApi = User::where('email',$user[0]->email)->leftjoin('agencies','users.agency_id','=','agencies.id')->select('agencies.*')->get();
        $agency_id = $userApi[0]->id; // agency_id of user who is calling api
        $booking_id = $input['id'];
      
        $bookingApi = Booking::where('bookings.id',$booking_id)
                        ->leftjoin('users','bookings.agent_id','=','users.id')
                        ->leftjoin('agencies','users.agency_id','=','agencies.id')
                        ->select('agencies.*')
                        ->get();
        $agency_id_booking = $bookingApi[0]->id;
        
        if($agency_id != $agency_id_booking){
            $error = 1;
        }
        
        return $error;
    }
    private function permissionOwnerForReadBooking($token_array,$input){
        $user_id = $token_array[0];
        $user = User::where('id',$user_id)->get();
        $error = 0;
        $userApi = User::where('email',$user[0]->email)->leftjoin('agencies','users.id','=','agencies.owner_id')->select('agencies.*')->get();
        
        $agency_id = $userApi[0]->id; // agency_id of user who is calling api
        $booking_id = $input['id'];
        $bookingApi = Booking::where('bookings.id',$booking_id)
                        ->leftjoin('users','bookings.agent_id','=','users.id')
                        ->leftjoin('agencies','users.agency_id','=','agencies.id')
                        ->select('agencies.*')
                        ->get();
        $agency_id_booking = $bookingApi[0]->id;
        
        if($agency_id != $agency_id_booking){
            $error = 1;
        }
        
        return $error;
    }
    private function permissionAdminForReadBooking(){
        $error = 0;
        return $error;
    }
}