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
$params = array(
	'client_id' => 'YOUR CLIENT ID',
	'client_secret' => 'YOUR CLIENT SECRET',
	'callback_url' => 'YOUR APP CALLBACK URL',
	'api_key' => 'YOUR API KEY',
	);

Config::setParams('oauth', $params);