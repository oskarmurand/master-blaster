<?

class Session {

	private static $_sessionStarted = false;

	public static function start(){
		if (self::$_sessionStarted == false){
			session_start();
			self::$_sessionStarted == true;
		}
	}

	public static function set($key, $value){
		$_SESSION[$key] = $value;
	}

	public static function get($key, $secondKey = false){
		if ($secondKey == true){
			if (isset($_SESSION[$key][$secondKey])){
				return $_SESSION[$key][$secondKey];
			}
		} else {
			if (isset($_SESSION[$key])){
				return $_SESSION[$key];
			}
		}
		return false;
	}

	public static function isAdmin(){
		if($_SESSION['user']['usertype'] == 'admin'){
			return true;
		} else {
			return false;
		}
	}

	public static function getUsername(){
		if($_SESSION['user']['username']){
			return $_SESSION['user']['username'];
		} else {
			return false;
		}
	}


	public static function display(){
		echo '<pre>';
		print_r($_SESSION);
		echo '</pre>';
	}
}

?>