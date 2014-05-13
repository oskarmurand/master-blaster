<? include_once "templates/includes/header.php" ?>
	<div id="wrapper" class="row clearfix">
		<p>You are logged in as <?=Session::getUsername()?></p>
		<? include_once "templates/includes/menu.php" ?>
		<div id="page-container">
			<h3><?=$results['pageTitle']?></h3>
			<div id="control-panel" class="row clearfix">
				<? if (Session::isAdmin()) {?>
				<div id="new-user" class="column one-fourth" style="height: 300px; background-color: black;">
					<h3>New User</h3>
				</div>
				<div id="edit-user" class="column one-fourth" style="height: 300px; background-color: black;">
					<h3>Edit existing user</h3>
				</div>
				<? } ?>
				<div id="activity-log" class="column one-fourth" style="height: 300px; background-color: black;">
					<h3>Activity log</h3>
				</div>
				<div id="settings" class="column one-fourth" style="height: 300px; background-color: black;">
					<h3>Personal settings</h3>
				</div>
			</div>
		</div>
	</div>
<? include_once "templates/includes/footer.php" ?>