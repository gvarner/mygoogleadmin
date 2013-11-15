<?php

/**
* @author zhzhussupovkz@gmail.com
* Groups class
*/

class Groups extends GoogleOAuth implements AuthRequests, RESTInterface {

	private function getScopeUrl() {
		return "https://www.googleapis.com/admin/directory/v1/groups/";
	}

	/*
	for get requests
	*/
	public function getRequest();

	/*
	for insert requests
	*/
	public function insertRequest();

	/*
	for delete requests
	*/
	public function deleteRequest();

	/*
	for list requests
	*/
	public function listRequest();

	/*
	for patch rqeuests
	*/
	public function patch();

	/*
	for update requests
	*/
	public function update();
}