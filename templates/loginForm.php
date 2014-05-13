<? include_once "templates/includes/header.php" ?>
	<div class="login-page-container">
		<div class="login-page-box" class="row clearfix">
			<div class="login-logo row clearfix">
				<a href="http://<?=BASE_URL?>/">
					<img src="images/logo.png" alt="Logo description">
				</a>
			</div>
			

			<? if ( (!empty($results['errorClass'])) && (!empty($results['errorMessage'])) ) { ?>
				<p class="<?=$results['errorClass'] ?>_message center"><?=$results['errorMessage']?></p>
			<? } ?>


			<? if (!Session::get('user')){ ?>
				<form id="front-page-login" class="login" action="?action=login" method="post">
					<div class="input row clearfix">
						<input type="text" name="username" value="<?=$_POST['username']?>" autocomplete="off" required>
						<label for="username">Username</label>
					</div>
					<div class="input row clearfix">
						<input type="password" name="password" value="" required>
						<label for="password">Password</label>
					</div>
					<span class="form-btns row clearfix">
						<input type="submit" class="primary-submit column half flow-opposite" name="submit" value="Log in">
						<a href="login.php?action=lostpw" class="column half no-margin">
							<input type="button" class="secondary-submit column full" name="lostpw" value="Lost password">
						</a>
					</span>
				</form>
			<? } else { ?>
				<div class="form-btns row clearfix">
					<a href="login.php?action=logout" class="column half">
						<input type="button" class="secondary-submit column full" value="Log out">
					</a>
					<a href="index.php" class="column half">
						<input type="button" class="primary-submit column full" value="To webpage">
					</a>
				</div>
			<? } ?>

		</div>
	</div>
<? include_once "templates/includes/footer.php" ?>