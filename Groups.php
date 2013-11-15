<?php

/**
* @author zhzhussupovkz@gmail.com
* Groups class
*/

class Groups extends Request {

	//return scope url for methods
	private function getScopeUrl() {
		return "https://www.googleapis.com/admin/directory/v1/groups/";
	}

	/*
	Retrieves a group's properties
	*/
	public function get();

	/*
	Creates a group
	*/
	public function insert();

	/*
	Deletes a group
	*/
	public function delete();

	/*
	Retrieves a paginated list of groups in a domain.
	*/
	public function list();

	/*
	Updates a group's properties. 
	This method supports patch semantics.
	*/
	public function patch();

	/*
	Updates a group
	*/
	public function update();

}