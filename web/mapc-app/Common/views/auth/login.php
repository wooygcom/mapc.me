<?php
$layout = 'admin-lte.page';

include(LAYOUT_PATH . $layout . '/head.php');
include(LAYOUT_PATH . $layout . '/header.php');

?>


<!-- Content : B -->

<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>로그인</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">로그인하세요.</p>

    <form method="post" action="./">
      <input type="hidden" name="_method" value="update" /><!-- POST, PUT, PATCH, DELETE -->
      <div class="form-group has-feedback">
        <input type="text" name="user_email" class="form-control" placeholder="아이디">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="user_password" class="form-control" placeholder="비밀번호">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> 계정기억
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">로그인</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!--
    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
-->
    <!-- /.social-auth-links -->

    <a href="regist">회원가입</a> || <a href="#">비밀번호 찾기</a><br>
    <a href="#" class="text-center">계정문의 : <?= $v['site']['email']; ?></a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- Content : E -->


<?php
// include(LAYOUT_PATH . 'admin-lte/_body.html');
include(LAYOUT_PATH . $layout . '/footer.php');
include(LAYOUT_PATH . $layout . '/foot.php');

// this is it
