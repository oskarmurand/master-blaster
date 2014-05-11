<?php 
	include("templates/includes/header.php");
	require_once('config.php');
	$results['pageTitle'] = "Login";

	$action = isset($_GET['action']) ? $_GET['action'] : "";
	switch ($action) {
  		case 'login':
    		login();
    		break;
    	case 'logout':
	   		logout();
	   		break;
		default:
			showForm();
	}

	function logIn(){
		$user = new User; //create a new instance of the Users class
		$user->storeFormValues($_POST);

		if($user->userLogin()) {
				echo "Welcome";
				$_SESSION['user'] = $user->username;
		} else {
				echo "Incorrect Username/Password"; 
		}
	}

	function logout(){
		
	}

	function showForm(){
		if (!isset($_SESSION['user']) && !isset($_POST['submit']) && !isset($_POST['username']) && !isset($_POST['password'])){ ?>
			<form action="?action=login" method="post">
				<table>
					<tr>
						<td>
							Name:
						</td>
						<td>
							<input type="text" name="username">
						</td>
					</tr>
					<tr>
						<td>
							Password:
						</td>
						<td>
							<input type="password" name="password">
						</td>
					</tr>
					<tr>
						<td>
							<input type="submit" name="submit" value="Log in">
						</td>
					</tr>
				</table>
			</form>

		<? } else { ?>
			<form action="?action=logout" method="post">
				<table>
					<tr>
						<td>
							<input type="submit" name="submit" value="Log out">
						</td>
					</tr>
				</table>
			</form>
		}
	} ?>
<?php include "templates/includes/footer.php" ?>