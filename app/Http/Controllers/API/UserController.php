<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use App\Booking; 

use App\ApiTokens; 
use \App\Group;
use Illuminate\Support\Facades\Auth; 
use Validator;
use Sentinel;

class UserController extends Controller 
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
        
        if( $data){ 
            $apitoken = new ApiTokens;
            $current_time = time();
            $valid_till = $current_time + 60*60*2;
            $success['token'] =  md5($data->id.'/'.$current_time.'/'.$request->email.'/'.$request->password); 
            $apitoken->token_string = $success['token'];
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

    public function create_booking(Request $request){
        $input = $request->all();
        
        $checkAuthentication = $this->getHeader($request);
        if($checkAuthentication){
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
        $checkAuthentication = $this->getHeader($request);
        if($checkAuthentication){
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
       $checkAuthentication = $this->getHeader($request);
       if($checkAuthentication){
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
       $checkAuthentication = $this->getHeader($request);
       if($checkAuthentication){
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
        $checkAuthentication = $this->getHeader($request);
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
        $checkAuthentication = $this->getHeader($request);
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
       $checkAuthentication = $this->getHeader($request);
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
       $checkAuthentication = $this->getHeader($request);
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
    private function getHeader(Request $request){
        $header = $request->header('token');
        $apiTokens = ApiTokens::where('token_string',$header)->get();
        $current_time = time();
        
        if($current_time <= $apiTokens[0]->valid_until)
           return true;
        else
            return false;
    }
   
}