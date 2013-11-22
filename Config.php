<?php

/**
* @author zhzhussupovkz@gmail.com
* Config class
*/

class Config {

	//application params
	private static $params = array();

	//set params
	public static function setParams($key, $value) {
		self::$params[$key] = $value;
	}

	//get params
	public static function getParams($key) {
		return self::$params[$key];
	}
}

//configurate
$oauth = array(
	'client_id' => 'YOUR CLIENT ID',
	'client_secret' => 'YOUR CLIENT SECRET',
	'redirect_uri' => 'YOUR APP REDIRECT URL',
	);

Config::setParams('oauth', $oauth);
