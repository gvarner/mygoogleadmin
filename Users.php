<?php

/**
* @author zhzhussupovkz@gmail.com
* Users class
*/

class Users extends GoogleOAuth implements AuthRequests {

	private function getScopeUrl() {
		return "https://www.googleapis.com/admin/directory/v1/users/";
	}
}