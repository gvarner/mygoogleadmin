<?php

/**
* @author zhzhussupovkz@gmail.com
* Request class
*/

class Request extends GoogleOAuth {

	private $googleAuth;

	public function __construct(GoogleOAuth $googleAuth) {
		return $this->googleAuth = $googleAuth;
	}

	/*
	get scope url
	*/
	public function getScopeUrl();

	/*
	GET requests by CURL
	*/
	protected function getCURL($method, $params) {
		return $this->googleAuth->getCURL($method, $params);
	}

	/*
	POST requests by CURL
	*/
	protected function postCURL($method, $params) {
		return $this->googleAuth->postCURL($method, $params);
	}

	/*
	DELETE requests by CURL
	*/
	protected function deleteCURL($method, $params) {
		return $this->googleAuth->deleteCURL($method, $params);
	}

	/*
	PUT requests by CURL
	*/
	protected function putCURL($method, $params) {
		return $this->googleAuth->deleteCURL($method, $params);
	}
}