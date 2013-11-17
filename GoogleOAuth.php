<?php

/**
* GoogleOAuth class
* @author zhzhussupovkz@gmail.com
*/

abstract class GoogleOAuth {

	//client id
	private $client_id;

	//client secret
	private $client_secret;

	//callback
	private $callback_url;

	//oauth token
	private $oauth_token;

	//oauth token secret
	private $oauth_token_secret;

	//oauth signature
	private $oauth_signature;

	//scope
	private $scope_url;

	//url
	private $oauth_url = "https://accounts.google.com/o/oauth2/";

	//api url
	private $api_url;

	//init
	protected function init() {
		$config = Config::getParams('oauth');
		$this->client_id = $config['client_id'];
		$this->client_secret = $config['client_secret'];
		$this->callback_url = $config['callback_url'];
	}

	/*
	GET request by curl
	*/
	protected function getCURL($method, $params) {
		if (!empty($params))
			$params = '?'.http_build_query($params);
		else
			$params = '';

		$url = $this->getApiUrl() .'/'. $method . $params;
		$options = array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => 0,
		);
		$ch = curl_init();
		curl_setopt_array($ch, $options);
		$result = curl_exec($ch);
		curl_close($ch);
		$final = json_decode($result, TRUE);
		return $final;
	}

	/*
	POST request by curl
	*/
	protected function postCURL($method, $params) {
		if (!empty($params)) {
			foreach ($params as $key => $value) {
				$params[$key] = urlencode($value);
			}
		}
		$options = array(
			CURLOPT_URL => $this->getApiUrl().'/'.$method,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $params,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => 0,
			);
		$ch = curl_init();
		curl_setopt_array($ch, $options);
		$result = curl_exec($ch);
		curl_close($ch);
		$final = json_decode($result, TRUE);
		return $final;
	}

	/*
	PUT request by curl
	*/
	protected function putCURL($params) {
		$options = array(
			CURLOPT_URL => $this->getApiUrl(),
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $params,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_VERBOSE => true,
			CURLOPT_CUSTOMREQUEST => "PUT",
			);
		$ch = curl_init();
		curl_setopt_array($ch, $options);
		$result = curl_exec($ch);
		curl_close($ch);
		$final = json_decode($result);
		return $final;
	}


	/*
	DELETE request by curl
	*/
	protected function deleteCURL($params) {
		$options = array(
			CURLOPT_URL => $this->getApiUrl(),
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $params,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_VERBOSE => true,
			CURLOPT_CUSTOMREQUEST => "DELETE",
			);
		$ch = curl_init();
		curl_setopt_array($ch, $options);
		$result = curl_exec($ch);
		curl_close($ch);
		$final = json_decode($result);
		return $final;
	}

	/*
	PATCH request by curl
	*/
	protected function patchCURL($params) {
		$options = array(
			CURLOPT_URL => $this->getApiUrl(),
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $params,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_VERBOSE => true,
			CURLOPT_CUSTOMREQUEST => "PATCH",
			);
		$ch = curl_init();
		curl_setopt_array($ch, $options);
		$result = curl_exec($ch);
		curl_close($ch);
		$final = json_decode($result);
		return $final;
	}

	//set scope
	protected function setScopeUrl($scope) {
		$this->scope_url = $scope;
	}

	//get scope
	protected function getScopeUrl() {
		return $this->scope_url;
	}

	//set api url
	protected function setApiUrl($url) {
		$this->api_url = $url;
	}

	//get api ur;
	protected function getApiUrl() {
		return $this->api_url;
	}
}