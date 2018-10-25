<?php

require_once __DIR__ . '/API.php';
$shore_excursions_api = new Shore_Excursions_API();

/////////////////////////// Login Functionality ///////////////////////////////

$login_array = array(
	"email"        => "greta@gmail.com",
	"password"     => "123456"
);

$shore_excursions_api->setAPIKey('$2y$10$nhDzzuhLO6smVZlg4hcgou1yEmZQ7/KK7UG/LWInt/UtKRPbU5MeC');

//Only use for owner, agents, and agent admins
$shore_excursions_api->setAgencyAPIKey('$2y$10.MhxDEqdeDucL6h2g8VL6P3bf84.sg8Opyw7RLvu');

if ($token = $shore_excursions_api->login($login_array)) {
	//echo $token;exit;
	$shore_excursions_api->setToken($token);
}

//////////////////////////// Create Booking Functionality ////////////////////////

$booking_array =  array(
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
			'agency_name'=>'Agency 1',
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
			'agent_id'=>'26'
		);

$response = $shore_excursions_api->createBooking($booking_array);

//////////////////////////// Edit Booking Functionality ////////////////////////

$data_array =  array(
			'id'=> 915,
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
			'agent_id'=>'26'
		);

$response = $shore_excursions_api->editBooking($data_array);

//////////////////////////// Read Booking Functionality ////////////////////////

$id = 1;
$response = $shore_excursions_api->getBooking($id);

//////////////////////////// Delete Booking Functionality ////////////////////////

$id = 1;
//$response = $shore_excursions_api->deletebooking($id);

//////////////////////////// Create Group Functionality ////////////////////////

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

$response = $shore_excursions_api->creategroup($data_array);

//////////////////////////// Edit Group Functionality ////////////////////////

$data_array =  array(
			'id'=>71,
			'name'=>'changing message',
			'url'=>'alaskaontheislandprincessaugust2',
			'email'=>'test@test.com',
			'ship_id'=>1,
			'sail_date'=>'2018-01-23 00=00:00',
			'duration'=>7,
			'text'=>'NOW IS THE TIME to reserve your tours for this exciting voyage! Below are the most popular tours in each port. <a href="https=//www.shoreexcursionsgroup.com/results">Click here</a> to view a full list of excursions available based on your time in port. All tours are first come, first served. So, don\'t delay. We would not want you to miss out!!',
			'image'=>'//media0.shoreexcursionsgroup.com/docs/groups/1117.jpg'
		);
$response = $shore_excursions_api->editgroup($data_array);

//////////////////////////// Read Group Functionality ////////////////////////

$id = 1;
$response = $shore_excursions_api->readgroup($id);

//////////////////////////// Delete Group Functionality ////////////////////////
/**
   For deleting a group the group id is passed by $id.
   Token is passed through the function to determine if it matches then will delete the group.
*/

$id = 1645;
$response = $shore_excursions_api->deletegroup($id);

?>