<?php
$layout = 'admin-lte.page';

include(LAYOUT_PATH . $layout . '/head.php');
include(LAYOUT_PATH . $layout . '/header.php');

?>

    <!-- Content : B -->

    <div class="login-box">
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">회원정보</p>
            <ul>
                <li>access_token : <?=$v['access_token']?></li>
            <?php foreach($v['userInfos'] as $key => $var) { ?>
                <li><?=$key?> : <?=$var?></li>
            <?php } ?>
            </ul>

            <a href="<?= ROOT_URL; ?>CommonAdmin/users/">회원관리</a>
            <a href="<?= $v['url']['oAuthServer']; ?>oAuth/server?mode=logout">로그아웃</a>

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

