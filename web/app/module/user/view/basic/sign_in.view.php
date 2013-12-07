<section>

	<form method="post" action="<?= $URL['user']['sign_in_act']; ?>" class="form-signin">

		<h1 class="form-signin-heading"><?= $LANG['user']['alt_sign_in']; ?></h1>

		<div class="form-group">
			<label>
				<?= $LANG['user']['email']; ?>
			</label>
			<input name="user_id" type="text" class="form-control" placeholder="<?= $LANG['user']['email']; ?>" autofocus="autofocus">
		</div>

		<div class="form-group">
			<label>
				<?= $LANG['user']['passwd']; ?>
			</label>
			<input name="user_passwd" type="password" class="form-control" placeholder="<?= $LANG['user']['passwd']; ?>">
		</div>

		<label class="checkbox">
			<input type="checkbox" value="remember-me"> <?= $LANG['user']['alt_sign_in_info_save']; ?>
		</label>

		<div class="form-group">
			<button class="btn btn-lg btn-primary btn-block" type="submit"><?= $LANG['user']['sign_in']; ?></button>
		</div>
	</form>

	<a href="<?= $URL['user']['sign_up']; ?>">회원가입</a>

</section>
