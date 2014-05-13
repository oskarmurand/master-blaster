<?php
	require_once('config.php');
	session_start();
	
	if(!Session::get('user')){
		header('Location: login.php');
		exit();
	}

	$action = isset($_GET['action']) ? $_GET['action'] : "";
	switch ($action) {
	  case 'login':
	    login();
	    break;
	  default:
	    homepage();
	}

	function homepage(){
		$results = array();
	  	$results['pageTitle'] = "Filebrowser";
	  	$results['bodyClass'] = "filebrowser";
	  	require(TEMPLATE_PATH."/home.php");
	}

?>
	
