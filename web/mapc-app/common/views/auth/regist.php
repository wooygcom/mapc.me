<?php
$layout = 'admin-lte.page';

include(LAYOUT_PATH . $layout . '/head.php');
include(LAYOUT_PATH . $layout . '/header.php');
?>

<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><?= _('회원가입'); ?></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg"><?= _('새로등록'); ?></p>

    <form action="regist" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="name" class="form-control" placeholder="<?= _('이름'); ?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="<?= _('이메일'); ?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="pwd" class="form-control" placeholder="<?= _('암호'); ?>">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="pwd_retype" class="form-control" placeholder="<?= _('암호확인'); ?>">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="memo" class="form-control" placeholder="<?= _('메모'); ?>">
        <span class="glyphicon glyphicon-file form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> <a href="#">회원가입약관</a>에 동의합니다.
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat"><?= _('등록'); ?></button>
        </div>
        <!-- /.col -->
      </div>
    </form>

<!--
    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
        Google+</a>
    </div>
-->

    <a href="login" class="text-center"><?= _('이미 회원인 경우'); ?></a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<?php
// include(LAYOUT_PATH . 'admin-lte/_body.html');
include(LAYOUT_PATH . $layout . '/footer.php');
include(LAYOUT_PATH . $layout . '/foot.php');

// this is it
