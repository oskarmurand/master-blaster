<?php
	require_once('config.php');
	Session::start();
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
		if (!Session::get('user')){
			$user = new User; //create a new instance of the Users class
			$user->storeFormValues($_POST);

			if($user->userLogin()) {
				//header('Location: /fep/');
				//exit;
			} else {
				header('Location: login.php?action=nopw');
				exit;
			}
		}
	}

	function logOut(){
		if (Session::get('user')){
			session_unset();
			header('Location: login.php');
			exit;
		}
	}

	function showForm(){
		$results['pageTitle'] = "Login";
		$results['bodyClass'] = "login";
		if (Session::get('user')){
			$results['errorClass'] = "regular";
			$results['errorMessage'] = "You are logged in as ".Session::get('user', 'firstname').' '.Session::get('user', 'lastname');
		}

		if ($_GET['action'] == "nopw") {
			$results['errorClass'] = "error";
			$results['errorMessage'] = "Wrong username or password!";
		}
		require(TEMPLATE_PATH . "/loginForm.php");
	} 
?>		