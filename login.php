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
	   		lostPw();
	   		break;
	   	case 'sendtoken':
	   		sendEmail();
	   		break;
	   	case 'mailerror':
	   		lostPw();
	   		break;
   		case 'mailsent':
   			lostPw();
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
			header('Location: login.php?action=exit');
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

		if ($_GET['action'] == "noaccess") {
			$results['errorClass'] = "error";
			$results['errorMessage'] = "You do not have access to that page. Please log in as an admin to continue.";
		}

		if ($_GET['action'] == "exit") {
			$results['errorClass'] = "success";
			$results['errorMessage'] = "You have successfully logged out";
		}
		
		require(TEMPLATE_PATH . "/loginForm.php");
	}

	function lostPw(){
		$results['pageTitle'] = "Lost Password";
		$results['bodyClass'] = "login";

		if ($_GET['action'] == "lostpw") {
			$results['errorClass'] = "regular";
			$results['errorMessage'] = "Please insert your email to change your password";
		}

		require(TEMPLATE_PATH . "/lostPassword.php");
	}

	function sendEmail(){

		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Host     = "localhost";
		$mail->From     = "erikweb@planet.ee";
		$mail->AddAddress("erikehrbach@gmail.com");
		$mail->Subject  = "Lost password";
		$mail->Body     = "Here comes text with a link to password changing page";
		$mail->WordWrap = 50;

		if(!$mail->Send()) {
			$success = 'error';
			Session::set('error', array(
				'errorClass' => 'error',
				'errorMessage' => 'Message was not sent. Mailer error: '. $mail->ErrorInfo
			));
		} else {
			$success = 'sent';
			Session::set('error', array(
				'errorClass' => 'success',
				'errorMessage' => 'Message has been sent.'
			));
		}

		header('Location: login.php?action=mail'.$success);
		exit;
	}
?>		