<?php

/**
* @author zhzhussupovkz@gmail.com
* Users class
*/

class Users extends Request {

	/*
	constructor
	*/
	public function __construct() {
		$this->setApiUrl('https://www.googleapis.com/admin/directory/v1/users');
		$this->setScopeUrl('https://www.googleapis.com/auth/admin.directory.user');
	}

	/*
	Retrieves a user
	*/
	public function get($userKey) {
		return $this->getRequest("$userKey", array());
	}

	/*
	Creates a user
	*/
	public function insert($familyName, $givenName, $password, $primaryEmail, $params = array()) {
		$required = array(
			'name' => array(
				'familyName' => $familyName,
				'givenName' => $givenName,
				),
			'password' => $password,
			'primaryEmail' => $primaryEmail,
		);
		$params = array_merge($required, $params);
		return $this->postRequest('', $params);
	}

	/*
	Deletes a user
	*/
	public function delete($userKey) {
		return $this->deleteRequest("$userKey", array());
	}

	/*
	Retrieves a paginated list of either 
	deleted users or all users in a domain
	*/
	public function list($params = array()) {
		return $this->getRequest('', $params);
	}

	/*
	Updates a user. 
	This method supports patch semantics.
	*/
	public function patch($userKey) {
		return $this->patchRequest("$userKey", array());
	}

	/*
	Updates a user
	*/
	public function update($params = array()) {
		return $this->putRequest("$userKey", $params);
	}

	/*
	Undeletes a deleted user.
	*/
	public function undelete() {
		return $this->postRequest($userKey.'/undelete', array());
	}

	/*
	Makes a user a super administrator
	*/
	public function makeAdmin($userKey) {
		return $this->postRequest($userKey.'/makeAdmin', array());
	}
}