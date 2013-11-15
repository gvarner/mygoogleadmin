<?php

/**
* @author zhzhussupovkz@gmail.com
* Users class
*/

class Users extends Request {

	//return scope url for methods
	private function getScopeUrl() {
		return "https://www.googleapis.com/admin/directory/v1/users/";
	}

	/*
	Retrieves a user
	*/
	public function get();

	/*
	Creates a user
	*/
	public function insert();

	/*
	Deletes a user
	*/
	public function delete();

	/*
	Retrieves a paginated list of either 
	deleted users or all users in a domain
	*/
	public function list();

	/*
	Updates a user. 
	This method supports patch semantics.
	*/
	public function patch();

	/*
	Updates a user
	*/
	public function update();

	/*
	Undeletes a deleted user.
	*/
	public function undelete();

	/*
	Makes a user a super administrator
	*/
	public function makeAdmin();
}