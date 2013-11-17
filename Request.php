<?php

/**
* @author zhzhussupovkz@gmail.com
* Request class
*/

class Request extends GoogleOAuth {

	//GoogleOAuth object
	private $googleOAuth;

	//constructor
	public function __construct(GoogleOAuth $googleOAuth) {
		$this->googleOAuth = $googleOAuth;
	}

	/*
	get scope url
	*/
	protected function getScopeUrl() {
		return $this->googleOAuth->getScopeUrl();
	}

	/*
	return api url
	*/
	protected function getApiUrl() {
		return $this->googleOAuth->getApiUrl();
	}

	/*
	GET requests by CURL
	*/
	protected function getRequest($method, $params) {
		return $this->googleOAuth->getCURL($method, $params);
	}

	/*
	POST requests by CURL
	*/
	protected function postRequest($method, $params) {
		return $this->googleOAuth->postCURL($method, $params);
	}

	/*
	DELETE requests by CURL
	*/
	protected function deleteRequest($method, $params) {
		return $this->googleOAuth->deleteCURL($method, $params);
	}

	/*
	PUT requests by CURL
	*/
	protected function putRequest($method, $params) {
		return $this->googleOAuth->putCURL($method, $params);
	}
}