<?php 
	require_once('config.php');
	session_start();
	$action = isset($_GET['action']) ? $_GET['action'] : "";

	switch ($action) {
	  case 'login':
	    login();
	    break;
	  default:
	    homepage();
	}

	function login(){
		$results = array();
  		$results['pageTitle'] = "Login";
  		require("login.php");
	}

	function homepage(){
		if(!isset($_SESSION['user'])){
			header('Location: login.php');
			exit();
		} else {
			$results = array();
	  		$results['pageTitle'] = "Filebrowser";
	  		require(TEMPLATE_PATH."/home.php");
  		}
	}

?>
	
