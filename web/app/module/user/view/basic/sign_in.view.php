<?php
    // if not use sign up
    if(! $VIEW['body']['sign_in_use']) {
    	// #TODO 페이지 안에 이 코드를 넣을것.
        $temp['width'] = 'col-md-6 col-md-offset-3';
        $temp['width'] = '';
    }
?>

<section class="<?= $temp['width']; ?>">

	<form method="post" action="<?= $URL['user']['sign_in_act']; ?>" class="form-signin">

		<h1 class="form-signin-heading"><?= _('들어가기'); ?></h1>

		<div class="form-group">
			<label>
				<?= _('이메일'); ?>
			</label>
			<input name="user_id" type="text" class="form-control" placeholder="<?= _('이메일'); ?>" autofocus="autofocus">
		</div>

		<div class="form-group">
			<label>
				<?= _('암호'); ?>
			</label>
			<input name="user_passwd" type="password" class="form-control" placeholder="<?= _('암호'); ?>">
		</div>

		<?php
			if($VIEW['is_save_user_info']) {
		?>

		<label class="form-group">
			<input type="checkbox" value="remember-me"> <?= _('사용자 정보를 저장합니다.'); ?>
		</label>

		<?php
			}
		?>
		<div class="form-group">
			<button class="btn btn-lg btn-primary btn-block" type="submit"><?= _('들어가기'); ?></button>
		</div>
	</form>

</section>


<?php
    if($VIEW['body']['sign_in_use']) {
        // #TODO include(sign_up.view.php); // 가입폼이 현재는 sign_in, sign_up 두군데에 있음...
?>
<section class="col-md-6">

	<form method="post" action="<?= $URL['user']['sign_up_act']; ?>" class="form-signin" role="form">

		<h1 class="form-signin-heading"><?= _('가입'); ?></h1>

        <input type="hidden" name="user_group" value="<?= $VIEW['body']['user_group']; ?>"/>
        <input type="hidden" name="user_uid" value="<?= $user_info['user_uid']; ?>"/>

		<div class="form-group">
			<label>
				<?= _('이름'); ?>
			</label>
			<input type="text" name="user_name" value="<?= $user_info['user_name']; ?>" class="form-control" placeholder="<?= _('이름'); ?>" />
		</div>

		<div class="form-group">
			<label>
				<?= _('이메일'); ?>
			</label>
			<input type="text" name="user_email" value="<?= $user_info['user_email']; ?>" class="form-control" placeholder="<?= _('이메일'); ?>" />
		</div>

		<div class="form-group">
			<label>
				<?= _('암호'); ?>
			</label>
			<input type="password" name="user_passwd" value="" class="form-control" placeholder="<?= _('암호'); ?>" />
		</div>

		<div class="form-group">
			<label>
				<?= _('암호 확인'); ?>
			</label>
			<input type="password" name="user_passwd_confirm" value="" class="form-control" placeholder="<?= _('암호 확인'); ?>" />
		</div>

		<div class="form-group">
			<button type="submit" value="submit" class="btn btn-lg btn-primary btn-block" /><?= _('가입'); ?></button>
		</div>

	</form>

</section>
<?php
    }
?>
