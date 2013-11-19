<?php

/**
* @author zhzhussupovkz@gmail.com
* class MyGoogleAdmin
*/

class MyGoogleAdmin {

	//instance
	private static $instance;

	//oauth conf
	private $oauth_params;

	//oauth url
	private $oauth_url = "https://accounts.google.com/o/oauth2/auth";

	//get token url
	private $token_url = "https://accounts.google.com/o/oauth2/token";

	//admin directory url
	private $url = 'https://www.googleapis.com/admin/directory/v1';

	//scope url
	private $scope_url = 'https://www.googleapis.com/auth/admin.directory';

	//constructor
	private function __construct() {
		$this->oauth_params = Config::getParams('oauth');
	}

	//init
	public static function init() {
		if(empty(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	//get code
	public function get_code($scopes) {
		$all_scopes = array();
		foreach ($scopes as $k => $v) {
			$all_scopes[] = $this->scope_url.'.'.$v;
		}
		$scope = implode(' ', $all_scopes);
		$params = array(
			'client_id' => $this->oauth_params['client_id'],
			'redirect_uri' => $this->oauth_params['redirect_uri'],
			'response_type' => 'code',
			'scope' => $scope,
			'state' => 'profile',
			'access_type' => 'offline',
			'approval_prompt' => 'force',
			);
		$location = $this->oauth_url.'?'.http_build_query($params);
		header("Location: ".$location);
	}

	//get token type: bearer
	public function get_bearer_token() {
		if (isset($_GET['code'])) {
			$code = $_GET['code'];

			$fields = array(
				'code' => $code,
				'client_id' => $this->oauth_params['client_id'],
				'client_secret' => $this->oauth_params['client_secret'],
				'redirect_uri' => $this->oauth_params['redirect_uri'],
				'grant_type' => 'authorization_code',
				);

			$fields = http_build_query($fields);

			$header = array(
				'POST /o/oauth2/token HTTP/1.1',
				'Host: accounts.google.com',
				'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
			);

			$ch = curl_init();
			$options = array(
				CURLOPT_URL => $this->token_url,
				CURLOPT_HTTPHEADER => $header,
				CURLOPT_POST => true,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_POSTFIELDS => $fields,
				CURLOPT_SSL_VERIFYPEER => 1,
				CURLOPT_HEADER => 0,
				CURLOPT_VERBOSE => true,
				);
			curl_setopt_array($ch, $options);
			$response = curl_exec($ch);
			curl_close($ch);
			$result = json_decode($response);
			return $result->access_token;
		}
	}

	//authorization get request
	private function get_auth($scope, $query, $params = array()) {
		$bearer_token = $this->get_bearer_token($scope);

		$header = array(
				'GET '.$this->url.'/'.$query.' HTTP/1.1',
				'Host: googleapis.com',
				'Authorization: Bearer '.$bearer_token,
			);

		if (!empty($params))
			$params = '?'.http_build_query($params);
		else
			$params = '';

		$ch = curl_init();
		$options = array(
			CURLOPT_URL => $this->url.'/'.$query . $params,
			CURLOPT_HTTPHEADER => $header,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => 0,
			);
		curl_setopt_array($ch, $options);
		$response = curl_exec($ch);
		curl_close($ch);
		$result = json_decode($response);
		return $result;
	}

	//authorization post request
	private function post_auth($scope, $query, $params = array()) {
		$bearer_token = $this->get_bearer_token($scope);

		$header = array(
				'POST '.$this->url.'/'.$query.' HTTP/1.1',
				'Host: googleapis.com',
				'Authorization: Bearer '.$bearer_token,
			);

		if (!empty($params))
			$fields = http_build_query($params);

		$ch = curl_init();
		$options = array(
			CURLOPT_URL => $this->url.'/'.$query,
			CURLOPT_HTTPHEADER => $header,
			CURLOPT_POSTFIELDS => $fields,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => 0,
			);
		curl_setopt_array($ch, $options);
		$response = curl_exec($ch);
		curl_close($ch);
		$result = json_decode($response);
		return $result;
	}

	//authorization custom request
	private function custom_auth($request_type, $scope, $query, $params = array()) {
			$bearer_token = $this->get_bearer_token($scope);

		$header = array(
				$request_type.' '.$this->url.'/'.$query.' HTTP/1.1',
				'Host: googleapis.com',
				'Authorization: Bearer '.$bearer_token,
			);

		if (!empty($params)) {
			foreach ($params as $key => $value) {
				$params[$key] = urlencode($value);
			}
		}

		$params = http_build_query($params);

		$ch = curl_init();
		$options = array(
			CURLOPT_URL => $this->url.'/'.$query . $params,
			CURLOPT_HTTPHEADER => $header,
			CURLOPT_POSTFIELDS => $params,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_CUSTOMREQUEST => $request_type,
			);
		curl_setopt_array($ch, $options);
		$response = curl_exec($ch);
		curl_close($ch);
		$result = json_decode($response);
		return $result;
	}

	/*
	***************** USER METHODS *********************
	*/

	/*
	Retrieves a user
	*/
	public function get_user($userKey) {
		return $this->get_auth(array('user'), "users/$userKey");
	}

	/*
	Creates a user
	*/
	public function insert_user($familyName, $givenName, $password, $primaryEmail, $params = array()) {
		$required = array(
			'name' => array(
				'familyName' => $familyName,
				'givenName' => $givenName,
				),
			'password' => $password,
			'primaryEmail' => $primaryEmail,
		);
		$params = array_merge($required, $params);
		return $this->post_auth(array('user'), "users", $params);
	}

	/*
	Deletes a user
	*/
	public function delete_user($userKey) {
		return $this->custom_auth("DELETE", array('user'), "users/$userKey");
	}

	/*
	Retrieves a paginated list of either 
	deleted users or all users in a domain
	*/
	public function list_user($params = array()) {
		return $this->get_auth(array('user'), "users", $params);
	}

	/*
	Updates a user. 
	This method supports patch semantics.
	*/
	public function patch_user($userKey) {
		return $this->custom_auth("PATCH", array('user'), "users/$userKey");
	}

	/*
	Updates a user
	*/
	public function update_user($userKey, $params = array()) {
		return $this->post_auth("PUT",array('user'), "users/$userKey", $params);
	}

	/*
	Undeletes a deleted user.
	*/
	public function undelete_user($userKey) {
		return $this->post_auth(array('user'), "users/$userKey/undelete");
	}

	/*
	Makes a user a super administrator
	*/
	public function make_admin_user($userKey) {
		return $this->post_auth(array('user'), "users/$userKey/makeAdmin");
	}


	/*
	************** GROUP METHODS ******************
	*/

	/*
	Retrieves a group's properties
	*/
	public function get_group($groupKey) {
		return $this->get_auth(array('group'), "groups/$groupKey");
	}

	/*
	Creates a group
	*/
	public function insert_group($email, $params = array()) {
		$required = array('email' => $email);
		$params = array_merge($required, $params);
		return $this->post_auth(array('group'), "groups", $params);
	}

	/*
	Deletes a group
	*/
	public function delete_group($groupKey) {
		return $this->custom_auth("DELETE", array('group'), "groups/$groupKey");
	}

	/*
	Retrieves a paginated list of groups in a domain.
	*/
	public function list_group($params = array()) {
		return $this->get_auth(array('group'), "groups", $params);
	}

	/*
	Updates a group's properties. 
	This method supports patch semantics.
	*/
	public function patch_group($groupKey) {
		return $this->custom_auth("PATCH", array('group'), "groups/$groupKey");
	}

	/*
	Updates a group
	*/
	public function update_group($groupKey, $params = array()) {
		return $this->custom_auth("PUT", array('group'), "groups/$groupKey", $params);
	}

}