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

			<? if (Session::get('error', 'errorClass') && Session::get('error', 'errorMessage')) { ?>
				<p class="<?=Session::get('error', 'errorClass')?>_message center"><?=Session::get('error', 'errorMessage')?></p>
			<? } ?>
			
			<?=Session::display()?>

			<form id="front-page-login" class="login" action="?action=sendtoken" method="post">
				<div class="input row clearfix">
					<input type="email" name="email" value="<?=$_POST['email']?>" autocomplete="off" required>
					<label for="email">Email</label>
				</div>
				<span class="form-btns row clearfix">
					<input type="submit" class="primary-submit column half flow-opposite" name="submit" value="Submit">
					<a onclick="history.go(-1);" class="column half no-margin">
						<input type="button" class="secondary-submit column full" value="Go back">
					</a>
				</span>
			</form>

		</div>
	</div>
<? include_once "templates/includes/footer.php" ?>