<?php
	$page_title = (empty($user_info['user_uid'])) ? $LANG['user']['sign_up'] : $LANG['user']['sign_in'];
?>

<section>

	<form method="post" action="<?= $URL['user']['sign_up_act']; ?>" class="form-signin" role="form">

		<h1 class="form-signin-heading"><?= $page_title; ?></h1>

		<input type="hidden" name="user_uid" value="<?= $user_info['user_uid']; ?>"/>

		<div class="form-group">
			<label>
				<?= $LANG['user']['name']; ?>
			</label>
			<input type="text" name="user_name" value="<?= $user_info['user_name']; ?>" class="form-control" placeholder="<?= $LANG['user']['name']; ?>" />
		</div>

		<div class="form-group">
			<label>
				<?= $LANG['user']['email']; ?>
			</label>
			<input type="text" name="user_email" value="<?= $user_info['user_email']; ?>" class="form-control" placeholder="<?= $LANG['user']['email']; ?>" />
		</div>

		<div class="form-group">
			<label>
				<?= $LANG['user']['passwd'];?>
			</label>
			<input type="password" name="user_passwd" value="" class="form-control" placeholder="<?= $LANG['user']['passwd']; ?>" />
		</div>

		<div class="form-group">
			<label>
				<?= $LANG['user']['passwd_confirm'];?>
			</label>
			<input type="password" name="user_passwd_confirm" value="" class="form-control" placeholder="<?= $LANG['user']['passwd_confirm']; ?>" />
		</div>

		<div class="form-group">
			<button type="submit" value="submit" class="btn btn-lg btn-primary btn-block" /><?= $page_title; ?></button>
		</div>

	</form>

	<a href="<?= $URL['user']['sign_in']; ?>"><?= $LANG['user']['sign_in'];?></a>

</section>
