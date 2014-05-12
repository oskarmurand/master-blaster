<?php
	require_once('config.php');
	session_start();
	ob_start();

	$results = array();
	$action = isset($_GET['action']) ? $_GET['action'] : "";
	switch ($action) {
  		case 'login':
    		logIn();
    		showForm();
    		break;
    	case 'logout':
	   		logOut();
	   		showForm();
	   		break;
	   	case 'lostpw':
	   		
	   		break;
		default:
			showForm();
	}

	function logIn(){
		if (!isset($_SESSION['user'])){
			$user = new User; //create a new instance of the Users class
			$user->storeFormValues($_POST);

			if($user->userLogin()) {
				$_SESSION['user'] = $user->username;
				header('Location: /fep/');
				exit;
			} else {
				header('Location: login.php?action=nopw');
				exit;
			}
		}
	}

	function logOut(){
		if (isset($_SESSION['user'])){
			unset($_SESSION['user']);
			header('Location: login.php');
			exit;
		}
	}

	function showForm(){
		$results['pageTitle'] = "Login";
		$results['bodyClass'] = "login";
		if ($_GET['action'] == "nopw") {
			//$results['errorClass'] = "warning";
			//$results['errorClass'] = "success";
			$results['errorClass'] = "error";
			$results['errorMessage'] = "Wrong username or password!";
		}
		require(TEMPLATE_PATH . "/loginForm.php");
	} 
?>		