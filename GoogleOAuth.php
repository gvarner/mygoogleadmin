<?php

/**
* GoogleOAuth class
* @author zhzhussupovkz@gmail.com
*/

abstract class GoogleOAuth {

	//client id
	private $client_id;

	//client secret
	private $client_secret;

	//callback
	private $callback_url;

	//oauth token
	private $oauth_token;

	//oauth token secret
	private $oauth_token_secret;

	//oauth signature
	private $oauth_signature;

	//url
	private $oauth_url = "https://accounts.google.com/o/oauth2/";

	//init
	protected static function init() {
		$config = Config::getParams('oauth');
		$this->client_id = $config['client_id'];
		$this->client_secret = $config['client_secret'];
		$this->callback_url = $config['callback_url'];
	}

	//get scope url
	abstract protected function getScopeUrl();

}