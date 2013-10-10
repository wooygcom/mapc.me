<form class="form-signin" method="post" action="<?= $URL['user']['root']; ?>&core_page=login_act">
	<h2 class="form-signin-heading"><?= $LANG['user']['alt_signin']; ?></h2>

	<input name="user_id" type="text" class="form-control" placeholder="<?= $LANG['user']['email']; ?>" autofocus="autofocus">
	<input name="user_passwd" type="password" class="form-control" placeholder="<?= $LANG['user']['password']; ?>">

	<label class="checkbox">
	<input type="checkbox" value="remember-me"> <?= $LANG['user']['alt_login_info_save']; ?>
	</label>

	<button class="btn btn-lg btn-primary btn-block" type="submit"><?= $LANG['user']['signin']; ?></button>
</form>
