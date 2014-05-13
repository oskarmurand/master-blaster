<?php
	require_once('config.php');
	session_start();
	
	if(!Session::get('user')){
		header('Location: login.php');
		exit();
	}

	$action = isset($_GET['action']) ? $_GET['action'] : "";
	switch ($action) {
	  case 'cp':
	    controlPanel();
	    break;
	  default:
	    homepage();
	}

	function homepage(){
		$results = array();
	  	$results['pageTitle'] = "File browser";
	  	$results['bodyClass'] = "filebrowser";
	  	require(TEMPLATE_PATH."/home.php");
	}

	function controlPanel(){
		$results = array();
	  	$results['pageTitle'] = "Control Panel";
	  	$results['bodyClass'] = "cp";
	  	require(TEMPLATE_PATH."/controlPanel.php");
	}

?>
	
