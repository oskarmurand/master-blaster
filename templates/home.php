<?php include "templates/includes/header.php" ?>
	<?
		if(!isset($_SESSION['user'])){
			header('Location: http://'.BASE_URL.'/index.php?action=login');
			exit();
		}
	?>
<?php include "templates/includes/footer.php" ?>