<?php
$layout = 'admin-lte.page';

$v['head']['extension'] = <<<EOT
<meta name="google-signin-scope" content="profile email">
<meta name="google-signin-client_id" content="399540537784-3n1kco1g7en85pjl9ta7ii6mub62s3d9.apps.googleusercontent.com">
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
EOT;

include(LAYOUT_PATH . $layout . '/head.php');
include(LAYOUT_PATH . $layout . '/header.php');

?>


    <!-- Content : B -->

    <div class="login-box">
        <div class="login-logo">
            <b><?= $v['site']['title']; ?></b><br />통합로그인
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">로그인하세요.</p>

            <form method="post" action="<?= $v['url']['oAuthServer']; ?>oAuth/server">
                <input type="hidden" name="mode" value="login" /><!-- POST, PUT, PATCH, DELETE -->
                <input type="hidden" name="redirect_uri" value="<?= $v['url']['oAuthClient']; ?>">
                <div class="form-group has-feedback">
                    <input type="text" name="user_email" class="form-control" placeholder="아이디" value="testclient">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="user_password" class="form-control" placeholder="비밀번호" value="testpass">
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

            <!-- /.social-auth-links -->
            <div class="social-auth-links text-center">
              <p>- OR -</p>
              <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                Facebook</a>
              <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                Google+</a>
            </div>



    <!-- google 로그인 : B -->
    <div id="my-signin2"></div>
    <script>
    function onSuccess(googleUser) {
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();

        $.ajax({
          method: "POST",
          url: "./core",
          data: { id: profile.getId() }
        });

        console.log("ID: " + profile.getId()); // Don't send this directly to your server!
        console.log('Full Name: ' + profile.getName());
        console.log('Given Name: ' + profile.getGivenName());
        console.log('Family Name: ' + profile.getFamilyName());
        console.log("Image URL: " + profile.getImageUrl());
        console.log("Email: " + profile.getEmail());

        // The ID token you need to pass to your backend:
        var id_token = googleUser.getAuthResponse().id_token;
        console.log("ID Token: " + id_token);
    }
    function onFailure(error) {
      console.log(error);
    }
    function renderButton() {
      gapi.signin2.render('my-signin2', {
        'scope': 'profile email',
        'width': 240,
        'height': 50,
        'longtitle': true,
        'theme': 'dark',
        'onsuccess': onSuccess,
        'onfailure': onFailure
      });
    }
    </script>
    <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
    <!-- google 로그인 : E -->


    <!-- 카카오 로그인 : B -->
    <a id="kakao-login-btn"></a>
    <a href="http://developers.kakao.com/logout"></a>
    <script type='text/javascript'>
      //<![CDATA[
        // 사용할 앱의 JavaScript 키를 설정해 주세요.
        Kakao.init('650843e0f95d2e78739f779d738525df');
        // 카카오 로그인 버튼을 생성합니다.
        Kakao.Auth.createLoginButton({
          container: '#kakao-login-btn',
          success: function(authObj) {
            $.ajax({
              method: "POST",
              dataType: "json",
              url: "./core",
              data: { access_token: authObj.access_token }
            });
            alert(JSON.stringify(authObj));
          },
          fail: function(err) {
             alert(JSON.stringify(err));
          }
        });
      //]]>
    </script>
    <!-- 카카오 로그인 : E -->

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
