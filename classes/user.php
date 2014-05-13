<?php
/* http://forum.codecall.net/topic/69771-creating-a-simple-yet-secured-loginregistration-with-php5/ */

class User {
	public $username = null;
	public $password = null;
	public $usertype = null;
	public $email = null;
	public $salt = "Zo4rU5Z1YyKJAASY0PT6EUg7BBYdlEhPaNLuxAwU8lqu1ElzHv0Ri7EM6irpx5w";

	public function __construct($data = array()){
		if (isset($data['username'])){
			$this->username = stripcslashes(strip_tags($data['username']));
		}
		if (isset($data['password'])){
			$this->password = stripcslashes(strip_tags($data['password']));
		}
		if (isset($data['usertype'])){
			$this->usertype = stripcslashes(strip_tags($data['usertype']));
		}
		if (isset($data['email'])){
			$this->email = stripcslashes(strip_tags($data['email']));
		}
	}

	public function storeFormValues($params){
		//Store the parameters
		$this->__construct($params);
	}

	public function userLogin(){
		$success = false;
		
		try {
			$con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			$sql = "SELECT * FROM fb_users WHERE username = :username AND password = :password LIMIT 1";
			$stmt = $con->prepare($sql);
			$stmt->bindValue("username", $this->username, PDO::PARAM_STR);
			$stmt->bindValue("password", hash("sha256", $this->password . $this->salt), PDO::PARAM_STR);
			$stmt->execute();
			$result = $stmt->fetch();

			if($result) {
				Session::set('user', array(
					'userid' 	=> $result->id,
					'username' 	=> $result->username,
					'firstname' => $result->firstname,
					'lastname' 	=> $result->lastname,
					'email' 	=> $result->email,
					'usertype' 	=> $result->usertype
				));

				Session::set('dog', 'pig');
				$success = true;
			}

			$con = null;
			return $success;

		} catch(PDOException $e) {
			echo $e->getMessage();
			return $success;
		}
	}

	public function newUser(){
		$correct = false;

		try {
			$con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO fb_users(username, email, password) VALUES(:username, :email, :password)";
			$stmt = $con->prepare($sql);
			$stmt->bindValue("username", $this->username, PDO::PARAM_STR);
			$stmt->bindValue("email", $this->email, PDO::PARAM_STR);
			$stmt->bindValue("password", hash("sha256", $this->password . $this->salt), PDO::PARAM_STR);
			$stmt->execute();
			  return "New user registered successfully!";
		} catch(PDOException $e){
			return $e->getMessage();
		}
	}

	public static function display($variable){
		echo '<pre>';
		print_r($variable);
		echo '</pre>';
	}
}

?>