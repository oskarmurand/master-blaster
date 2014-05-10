<?php
/* http://forum.codecall.net/topic/69771-creating-a-simple-yet-secured-loginregistration-with-php5/ */

class User {
	public $username = null;
	public $password = null;
	public $salt = "Zo4rU5Z1YyKJAASY0PT6EUg7BBYdlEhPaNLuxAwU8lqu1ElzHv0Ri7EM6irpx5w";

	public function __construct($data = array()){
		if (isset($data['username'])){
			$this->username = stripcslashes(strip_tags($data['username']))
		}
		if (isset($data['password'])){
			$this->password = stripcslashes(strip_tags($data['password']))
		}
	}

	public function storeFormValues($params){
		//Store the parameters
		$this->__construct($params);
	}

	public function userLogin(){
		$success = false;
	}
}

?>