<form class="form-signin">
<h2 class="form-signin-heading"><?= $LANG['user']['alt_signin']; ?></h2>
<input type="text" class="form-control" placeholder="<?= $LANG['user']['email']; ?>" autofocus="autofocus">
<input type="password" class="form-control" placeholder="<?= $LANG['user']['password']; ?>">
<label class="checkbox">
<input type="checkbox" value="remember-me"> <?= $LANG['user']['alt_login_info_save']; ?>
</label>
<button class="btn btn-lg btn-primary btn-block" type="submit"><?= $LANG['user']['signin']; ?></button>
</form>
