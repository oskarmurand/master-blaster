<?php include "templates/includes/header.php" ?>
	<div id="wrapper" class="row clearfix">
		<p>You are logged in as <?=Session::get('user', 'username')?></p>
		<a href="login.php">To the log out screen</a>
	</div>
<?php include "templates/includes/footer.php" ?>