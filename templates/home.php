<?php include "templates/includes/header.php" ?>
	<p>You are logged in as <?=Session::get('user', 'username')?></p>
	<a href="login.php">To the log out screen</a>
<?php include "templates/includes/footer.php" ?>