<?php 
	ob_start();
	require_once('config.php');

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
		$results = array();
  		$results['pageTitle'] = "Filebrowser";
  		require(TEMPLATE_PATH."/home.php");
	}

?>
	
