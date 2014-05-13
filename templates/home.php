<?php include "templates/includes/header.php" ?>
	<div id="wrapper" class="row clearfix">
		<p>You are logged in as <?=Session::getUsername()?></p>
		<? include_once "templates/includes/menu.php" ?>
		<div id="page-container">
			<h2><?=$results['pageTitle']?></h2>
			<div class="row clearfix">
				<div id="file-tree" class="column one-fourth" style="height: 500px; background-color: gray;">
					<h3>File-tree</h3>
				</div>
				<div id="file-browser" class="column half" style="height: 500px; background-color: gray;">
					<h3>File-browser</h3>
				</div>
				<div id="sidebar" class="column one-fourth" style="height: 500px; background-color: gray;">
					<h3>Sidebar</h3>
				</div>
			</div>
		</div>
	</div>
<?php include "templates/includes/footer.php" ?>