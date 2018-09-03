<?php

/** Autoloading The required Classes **/

class IndexController {

	function __construct(){ }

	public function callAPI($method, $url, $data, $token = NULL){
		$curl = curl_init();

		switch ($method){
			case "POST":
				curl_setopt($curl, CURLOPT_POST, 1);
				if ($data)
					curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
				break;
			case "PUT":
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
				if ($data)
					curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
				break;
			default:
				if ($data)
					$url = sprintf("%s?%s", $url, http_build_query($data));
		}

		// OPTIONS:
		curl_setopt($curl, CURLOPT_URL, $url);


		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'APIKEY: 111111111111111111111',
			'Content-Type: application/json',
			'token: '.$token,
		));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

		// EXECUTE:
		$result = curl_exec($curl);
		if(!$result){die("Connection Failure");}
		curl_close($curl);
		return $result;
	}
	public function index()
	{
		return "This is Api Call Index Page";
	}
	public function login()
	{

		$data_array =  array(
			"email"        => "christiangaviri@gmail.com",
			"password"     => "12345"
		);

		$get_data = $this->callAPI('POST', 'http://localhost/shoreexcursion_dev/httpdocs/api/login', json_encode($data_array));
		//$get_data = callAPI('GET', 'http=>//localhost/shoreexcursion_dev/httpdocs/api/login?email=christiangaviri@gmail.com&password=12345', false);
		$response = json_decode($get_data, true);
		$token =  $response['success']['token']; //65fd915b62e4ac2b21280238dad604d7
		$_SESSION['token'] = $token;
		if($token){
			echo "Login Successfully";
		}

	}
	public function createbooking()
	{


		$data_array =  array(
			'order_id'=>11234213,
			'order_date'=>'2016/07/08',
			'order_status'=>'processing',
			'order_notes'=>'This is a test note for a booking sdfasdgfdfd.',
			'payment_received'=>true,
			'paymentAmount'=>'50.00',
			'customer_phone_number'=>'561-287-2003',
			'customer_email_address'=>'christiangaviria@christiangaviria.com',
			'customer_email_sent'=>true,
			'first_name'=>'Christian',
			'last_name'=>'Gaviria',
			'agency_data'=>'',
			'agency_email_address'=>'',
			'agency_name'=>'',
			'agency_branding'=>false,
			'agency_bcc'=>true,
			'review_email_disabled'=>true,
			'ship_id'=>'1',
			'cruise_start_date'=>'2018/09/09',
			'cruise_duration'=>'7',
			'customer_notes'=>'This is a test customer note.',
			'notes_to_vendor'=>'This is a test note to vendor.',
			'accounting_notes'=>'This is a test accounting note.',
			'hold_emails_for_tour'=>false,
			'product_code'=>'BLTEST1_STANDARD',
			'product_name'=>'TEST Standard Tour',
			'options_list'=>'',
			'qty_adult'=>'1',
			'qty_children'=>'1',
			'quantity'=>'2',
			'discount_row'=>false,
			'total_price'=>'230.00',
			'affiliate_payment'=>'30.00',
			'total_vendor_cost'=>'10.00',
			'auto_confirm'=>true,
			'over_ride'=>false,
			'itinerary_works'=>'',
			'tour_date'=>'2018/10/10',
			'tour_time'=>'9=00am',
			'tour_duration'=>'3 hours',
			'buffer_time'=>'15 minutes',
			'vendor_title'=>'',
			'vendor_currency'=>'USD',
			'port'=>'',
			'port_arrival'=>'2018/11/11',
			'port_departure'=>'2018/11/17',
			'agent_id'=>'32'
		);
		//print_r($data_array);exit;
		$get_data = $this->callAPI('POST', 'http://localhost/shoreexcursion_dev/httpdocs/api/create_booking', json_encode($data_array), $_SESSION["token"]);
		$response = json_decode($get_data, true);
		print_r($response);
	}
	public function editbooking()
	{

		$data_array =  array(
			'id'=> 887,
			'order_id'=>123456,
			'order_date'=>'2016/07/08',
			'order_status'=>'processing',
			'order_notes'=>'This is a test note for a booking sdfasdgfdfd.',
			'payment_received'=>true,
			'paymentAmount'=>'50.00',
			'customer_phone_number'=>'561-287-2003',
			'customer_email_address'=>'christiangaviria@christiangaviria.com',
			'customer_email_sent'=>true,
			'first_name'=>'Christian',
			'last_name'=>'Gaviria',
			'agency_data'=>'',
			'agency_email_address'=>'',
			'agency_name'=>'',
			'agency_branding'=>false,
			'agency_bcc'=>true,
			'review_email_disabled'=>true,
			'ship_id'=>'1',
			'cruise_start_date'=>'2018/09/09',
			'cruise_duration'=>'7',
			'customer_notes'=>'This is a test customer note.',
			'notes_to_vendor'=>'This is a test note to vendor.',
			'accounting_notes'=>'This is a test accounting note.',
			'hold_emails_for_tour'=>false,
			'product_code'=>'BLTEST1_STANDARD',
			'product_name'=>'TEST Standard Tour',
			'options_list'=>'',
			'qty_adult'=>'1',
			'qty_children'=>'1',
			'quantity'=>'2',
			'discount_row'=>false,
			'total_price'=>'230.00',
			'affiliate_payment'=>'30.00',
			'total_vendor_cost'=>'10.00',
			'auto_confirm'=>true,
			'over_ride'=>false,
			'itinerary_works'=>'',
			'tour_date'=>'2018/10/10',
			'tour_time'=>'9=00am',
			'tour_duration'=>'3 hours',
			'buffer_time'=>'15 minutes',
			'vendor_title'=>'',
			'vendor_currency'=>'USD',
			'port'=>'',
			'port_arrival'=>'2018/11/11',
			'port_departure'=>'2018/11/17',
			'agent_id'=>'29'
		);

		$get_data = $this->callAPI('POST', 'http://localhost/shoreexcursion_dev/httpdocs/api/edit_booking', json_encode($data_array), $_SESSION["token"]);
		$response = json_decode($get_data, true);
		print_r($response);
	}
	public function readbooking()
	{
		$get_data = $this->callAPI('GET', 'http://localhost/shoreexcursion_dev/httpdocs/api/read_booking?id=1', false, $_SESSION["token"]);
		$response = json_decode($get_data, true);
		print_r($get_data);
	}
	public function deletebooking()
	{
		$get_data = $this->callAPI('GET', 'http://localhost/shoreexcursion_dev/httpdocs/api/delete_booking?id=888', false, $_SESSION["token"]);
		$response = json_decode($get_data, true);
		print_r($get_data);
	}
	public function creategroup()
	{
		$data_array =  array(
			'name'=>'testfdvfdvfd',
			'url'=>'alaskaontheislandprincessaugust2',
			'email'=>'jliescheidt@dt.com',
			'ship_id'=>1,
			'sail_date'=>'2018-01-23 00=00:00',
			'duration'=>7,
			'text'=>'NOW IS THE TIME to reserve your tours for this exciting voyage! Below are the most popular tours in each port. <a href="https=//www.shoreexcursionsgroup.com/results">Click here</a> to view a full list of excursions available based on your time in port. All tours are first come, first served. So, don\'t delay. We would not want you to miss out!!',
			'image'=>'//media0.shoreexcursionsgroup.com/docs/groups/1117.jpg'
		);
		$get_data = $this->callAPI('POST', 'http://localhost/shoreexcursion_dev/httpdocs/api/create_group', json_encode($data_array), $_SESSION["token"]);
		$response = json_decode($get_data, true);
		print_r($response);
	}
	public function editgroup()
	{
		$data_array =  array(
			'id'=>71,
			'name'=>'changing message',
			'url'=>'alaskaontheislandprincessaugust2',
			'email'=>'jliescheidt@dt.com',
			'ship_id'=>1,
			'sail_date'=>'2018-01-23 00=00:00',
			'duration'=>7,
			'text'=>'NOW IS THE TIME to reserve your tours for this exciting voyage! Below are the most popular tours in each port. <a href="https=//www.shoreexcursionsgroup.com/results">Click here</a> to view a full list of excursions available based on your time in port. All tours are first come, first served. So, don\'t delay. We would not want you to miss out!!',
			'image'=>'//media0.shoreexcursionsgroup.com/docs/groups/1117.jpg'
		);
		$get_data = $this->callAPI('POST', 'http://localhost/shoreexcursion_dev/httpdocs/api/edit_group', json_encode($data_array), $_SESSION["token"]);
		$response = json_decode($get_data, true);
		print_r($response);
	}
	public function readgroup()
	{

		$get_data = $this->callAPI('GET', 'http://localhost/shoreexcursion_dev/httpdocs/api/read_group?id=1', false, $_SESSION["token"]);
		$response = json_decode($get_data, true);
		print_r($get_data);
	}
	public function deletegroup()
	{
		$get_data = $this->callAPI('GET', 'http://localhost/shoreexcursion_dev/httpdocs/api/delete_group?id=1645', false, $_SESSION["token"]);
		$response = json_decode($get_data, true);
		print_r($get_data);
	}

}

?>