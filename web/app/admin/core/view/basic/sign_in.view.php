<?php
{ // BLOCK:bare_code:20150918
/*
	<form method="post" action="<?= $URL['core']['root']; ?>admin-core/sign_in_act/" class="form-signin">
    <input type="hidden" name="link_to" value="<?= $VIEW['link_to']; ?>"/>
	<input name="user_id" type="text" placeholder="<?= _('이메일'); ?>" autofocus="autofocus" class="form-control">
	<input name="user_passwd" type="password" placeholder="<?= _('암호'); ?>" class="form-control">
	<input type="checkbox" value="remember-me"> <?= _('사용자 정보를 저장합니다.'); ?>
	<button type="submit"><?= _('들어가기'); ?></button>
	</form>
*/
} // BLOCK
?>

    <div class="login-box">
      <div class="login-logo">
        <a href="../../index2.html"><b><?= _('관리자페이지'); ?></b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg"><?= _('로그인해주세요.'); ?></p>
        <form action="<?= $URL['core']['root']; ?>admin-core/sign_in_act/" method="post">
        <input type="hidden" name="user_group" value="<?= $VIEW['body']['user_group']; ?>"/>
        <input type="hidden" name="user_uid" value="<?= $user_info['user_uid']; ?>"/>
          <div class="form-group has-feedback">
          	<input name="user_id" type="text" placeholder="<?= _('이메일 또는 아이디'); ?>" autofocus="autofocus" class="form-control">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
			<input name="user_passwd" type="password" placeholder="<?= _('암호'); ?>" class="form-control">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> 로그인 유지
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat"><?= _('들어가기'); ?></button>
            </div><!-- /.col -->
          </div>
        </form>

<!--
// #TODO 소셜로그인기능 추가...(일반페이지만...)
        <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> 페이스북으로 로그인</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> 구글로 로그인</a>
        </div>

        <a href="#"><?= _('암호초기화'); ?></a><br>
        <a href="register.html" class="text-center"><?= _('가입하기'); ?></a>
-->

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
