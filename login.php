<?php 
	require_once('config.php');
	session_start();
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
		if (!isset($_SESSION['user'])){
			$user = new User; //create a new instance of the Users class
			$user->storeFormValues($_POST);

			if($user->userLogin()) {
				$_SESSION['user'] = $user->username;
				header('Location: /fep/');
				exit;
			} else {
				echo "Incorrect Username/Password"; 
			}
		}
	}

	function logout(){
		if (isset($_SESSION['user'])){
			unset($_SESSION['user']);
			header('Location: index.php');
			exit;
		} 
	}

	function showForm(){
		if (!isset($_SESSION['user'])){ ?>
			<form action="?action=login" method="post">
				<table>
					<tr>
						<td>
							Name:
						</td>
						<td>
							<input type="text" name="username" value="<?=$_POST['username']?>">
						</td>
					</tr>
					<tr>
						<td>
							Password:
						</td>
						<td>
							<input type="password" name="password" value="">
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
							Log Out
						</td>
						<td>
							<input type="submit" name="submit" value="Log out">
						</td>
					</tr>
				</table>
			</form>
		<? }

		echo "<pre>";
		print_r($_SESSION);
		echo "</pre>";
	} ?>