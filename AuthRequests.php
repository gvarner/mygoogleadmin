<?php

/**
* @author zhzhussupovkz@gmail.com
* AuthRequests - interface for authorization requests
*/

interface AuthRequests {

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