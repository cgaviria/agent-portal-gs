<?php

class Shore_Excursions_API {
	CONST PRODUCTION_URL = 'http://devagents.shoreexcursionsgroup.com/api/';
	CONST STAGING_URL = 'http://devagents.shoreexcursionsgroup.com/api/';
	//CONST STAGING_URL = 'http://localhost/agent-portal-gs/httpdocs/api/';
	protected $_url = self::STAGING_URL;
	protected $_api_key;
	protected $_agency_api_key;
	protected $_token;

	public function callAPI($method, $url, $data, $api_key, $agency_api_key = null, $token = null)
	{
		$curl = curl_init();

		switch ($method) {
			case "POST":
				curl_setopt($curl, CURLOPT_POST, 1);
				if ($data) {
					curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
				}
				break;
			case "PUT":
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
				if ($data) {
					curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
				}
				break;
			default:
				if ($data) {
					$url = sprintf("%s?%s", $url, http_build_query($data));
				}
		}
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_URL, $url);
        $array = array($api_key,$agency_api_key);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			//'api_key: ' . $api_key,
			//'agency_api_key: ' . $agency_api_key,
			'Content-Type: application/json',
			'token: ' . $token,
			'Authorization: '.$api_key.'##'.$agency_api_key
		));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

		$result = curl_exec($curl);
		echo $url;
		echo $result;
		if (!$result) {
			die("Connection Failure");
		}

		curl_close($curl);

		return $result;
	}

	public function setAPIKey($api_key)
	{
		$this->_api_key = $api_key;

		return $this;
	}

	public function setAgencyAPIKey($agency_api_key)
	{
		$this->_agency_api_key = $agency_api_key;

		return $this;
	}

	public function setToken($token)
	{
		$this->_token = $token;

		return $this;
	}

	public function setEnvironment($environment = 'staging')
	{
		if ($environment == 'production') {
			$this->_url = self::PRODUCTION_URL;
		} else {
			$this->_url = self::STAGING_URL;
		}

		return $this;
	}

	public function login($login_array)
	{
		$data_array =  array(
			"email"        => $login_array['email'],
			"password"            => $login_array['password']
		);

		$get_data = $this->callAPI('POST', $this->_url . 'login', json_encode($data_array), $this->_api_key, $this->_agency_api_key);
		$response = json_decode($get_data, true);
		$token = $response['success']['token'];

		if ($token) {
			return $token;
		}
	}

	public function createBooking($booking_array)
	{
		$get_data = $this->callAPI('POST', $this->_url . 'create_booking', json_encode($booking_array), $this->_api_key, $this->_agency_api_key, $this->_token);
		$response = json_decode($get_data, true);
		return ($response);
	}

	public function editBooking($data_array)
	{
		$get_data = $this->callAPI('POST', $this->_url . 'edit_booking', json_encode($data_array), $this->_api_key, $this->_agency_api_key, $this->_token);
		$response = json_decode($get_data, true);
		return($response);
	}

	public function getBooking($id)
	{
		$get_data = $this->callAPI('GET', $this->_url . 'read_booking?id=' . $id, false, $this->_api_key, $this->_agency_api_key, $this->_token);
		$response = json_decode($get_data, true);
		return($get_data);
	}

	public function deleteBooking($id)
	{
		$get_data = $this->callAPI('GET', $this->_url . 'delete_booking?id=' . $id, false, $this->_api_key, $this->_agency_api_key, $this->_token);
		$response = json_decode($get_data, true);
		return($get_data);
	}

	public function createGroup($data_array)
	{
		$get_data = $this->callAPI('POST', $this->_url . 'create_group', json_encode($data_array), $this->_api_key, $this->_agency_api_key, $this->_token);
		$response = json_decode($get_data, true);
		return($response);
	}

	public function editGroup($data_array)
	{
		$get_data = $this->callAPI('POST', $this->_url . 'edit_group', json_encode($data_array), $this->_api_key, $this->_agency_api_key, $this->_token);
		$response = json_decode($get_data, true);
		return($response);
	}

	public function readGroup($id)
	{
		$get_data = $this->callAPI('GET', $this->_url . 'read_group?id='.$id, false, $this->_api_key, $this->_agency_api_key, $this->_token);
		$response = json_decode($get_data, true);
		return($get_data);
	}

	public function deleteGroup($id)
	{
		$get_data = $this->callAPI('GET', $this->_url . 'delete_group?id='.$id, false, $this->_api_key, $this->_agency_api_key, $this->_token);
		$response = json_decode($get_data, true);
		return($get_data);
	}
}

?>