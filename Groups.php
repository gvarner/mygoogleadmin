<?php

/**
* @author zhzhussupovkz@gmail.com
* Groups class
*/

class Groups extends Request {

	/*
	constructor
	*/
	public function __construct() {
		$this->setApiUrl('https://www.googleapis.com/admin/directory/v1/groups');
		$this->setScopeUrl('https://www.googleapis.com/auth/admin.directory.group');
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