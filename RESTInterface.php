<?php

/**
* @author zhzhussupovkz@gmail.com
* RESTInterface
*/

interface RESTInterface {

	/*
	GET requests by CURL
	*/
	protected function getCURL($method, $params);

	/*
	POST requests by CURL
	*/
	protected function postCURL($method, $params);

	/*
	DELETE requests by CURL
	*/
	protected function deleteCURL($method, $params);

	/*
	PUT requests by CURL
	*/
	protected function putCURL($method, $params);

}