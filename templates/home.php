<?php include "templates/includes/header.php" ?>
	<p>You are logged in as <?=$_SESSION['user']?></p>
	<a href="login.php?action=logout">Log out</a>
<?php include "templates/includes/footer.php" ?>