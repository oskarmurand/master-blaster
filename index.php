<?php
	require_once('config.php');
	session_start();
	
	if(!isset($_SESSION['user'])){
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
	  	require(TEMPLATE_PATH."/home.php");
	}

?>
	
