<?php
{ // BLOCK:bare_code:20150918
/*
<!DOCTYPE html>
<html>
  <head>
    <?php
      foreach($VIEW['headhook'] as $key => $var) {
        include($var . $key);
      }
    ?>
  </head>
  <body>
    <!-- 본문:H -->
    <?php
        if($section_file) {

            include($section_file);

        } else {

            echo $VIEW['message'];

        }
    ?>
    <!-- 본문:T -->

    <?php
      foreach($VIEW['script'] as $key => $var) {
        include($var . $key);
      }
    ?>
  </body>
</html>
*/
} // BLOCK
?>
<?php
    $active[$ARGS['modl']] = ' active ';
?>
<!DOCTYPE html>
<html>
  <head>
    <?php
      foreach($VIEW['headhook'] as $key => $var) {
        include($var . $key);
      }
    ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?= $URL['core']['root']; ?>vendor/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= $URL['core']['root']; ?>vendor/admin-lte/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?= $URL['core']['root']; ?>vendor/admin-lte/dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="<?= $URL['core']['admin']; ?>core" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>H</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b><?= $CONFIG['meta']['title']; ?></b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?= $URL['core']['root']; ?>vendor/admin-lte/dist/img/avatar5.png" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?= _('관리자'); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?= $URL['core']['root']; ?>vendor/admin-lte/dist/img/avatar5.png" class="img-circle" alt="User Image">
                    <p>
                      관리자
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat"><?= _('프로필'); ?></a>
                    </div>
                    <div class="pull-right">
                      <a href="<?= $URL['core']['root']; ?>admin-core/sign_out/" class="btn btn-default btn-flat"><?= _('로그아웃'); ?></a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
<?php
if(is_file(__DIR__ . '/menu.tpl.php')) {

    include(__DIR__ . '/menu.tpl.php');

} else {
?>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?= $active['user']; ?> treeview">
              <a href="#">
                <i class="fa fa-circle-o text-aqua"></i>
                <span>회원</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?= $URL['core']['admin']; ?>user/user-crud/"><i class="fa fa-circle-o"></i> 회원</a></li>
                <li><a href="<?= $URL['core']['admin']; ?>user/points/"><i class="fa fa-circle-o"></i> 마일리지</a></li>
                <li><a href="<?= $URL['core']['admin']; ?>user/actions/"><i class="fa fa-circle-o"></i> 활동기록</a></li>
              </ul>
            </li>
            <li class="<?= $active['bbs']; ?> treeview">
              <a href="#">
                <i class="fa fa-circle-o text-aqua"></i>
                <span>게시판</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?= $URL['core']['root']; ?>admin-mapc/list/"><i class="fa fa-circle-o"></i> 게시판</a></li>
              </ul>
            </li>
            <li class="<?= $active['shop']; ?> treeview">
              <a href="#">
                <i class="fa fa-circle-o text-aqua"></i>
                <span>쇼핑몰</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?= $URL['core']['root']; ?>admin-mapc/cate/"><i class="fa fa-circle-o"></i> 카테고리</a></li>
                <li><a href="<?= $URL['core']['root']; ?>admin-mapc/prod/"><i class="fa fa-circle-o"></i> 상품</a></li>
                <li><a href="<?= $URL['core']['root']; ?>admin-mapc-shop/orders/"><i class="fa fa-circle-o"></i> 주문</a></li>
              </ul>
            </li>
            <li class="<?= $active['calendar']; ?> treeview">
              <a href="#">
                <i class="fa fa-circle-o text-aqua"></i>
                <span>일정</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?= $URL['core']['admin']; ?>cal/dashboard/"><i class="fa fa-circle-o"></i> 일정</a></li>
              </ul>
            </li>
            <li class="<?= $active['etc']; ?> treeview">
              <a href="#">
                <i class="fa fa-circle-o text-aqua"></i>
                <span>기타</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?= $URL['core']['admin']; ?>popup/list/"><i class="fa fa-circle-o"></i> 팝업</a></li>
              </ul>
            </li>
            <li class="<?= $active['academy']; ?> treeview">
              <a href="#">
                <i class="fa fa-circle-o text-aqua"></i>
                <span>학원관리</span>w
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?= $URL['core']['admin']; ?>academy/attend/"><i class="fa fa-circle-o"></i> 출석관리</a></li>
              </ul>
            </li>
          </ul>
<?php
}
?>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?= $VIEW['page']['title'] ? $VIEW['page']['title'] : 'Dashboard'; ?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?= $URL['core']['admin_main']; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?= $VIEW['page']['title']; ?></li>
          </ol>
        </section>

      <!-- 본문:H -->
      <?php
          if($section_file) {

              include($section_file);

          } else {

              echo $VIEW['message'];

          }
      ?>
      <!-- 본문:T -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://wooyg.com">Wooyg.com</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

<?php
// #TODO requireJS를 제대로 쓸 수 있을 때 아래내용 정리하기...
if(false) {
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/require.js/2.1.20/require.min.js"></script>
<script type="text/javascript">
require.config({
    paths: {
        'jQuery': 'https://code.jquery.com/jquery-2.1.4.min',
        'jquery-ui': 'https://code.jquery.com/ui/1.11.4/jquery-ui',
        'bootstrap': '<?= $URL['core']['root']; ?>vendor/admin-lte/bootstrap/js/bootstrap.min.js',
        'admin-lte': '<?= $URL['core']['root']; ?>vendor/admin-lte/dist/js/app.min.js'
    },
    shim: {
        'jQuery': {
            exports: '$'
        },
        'jquery-ui': {
            deps: 'jQuery'
        },
        'bootstrap': {
            deps: 'jQuery'
        },
        'admin-lte': {
            deps: 'jQuery'
        }
    }
});
require(['jQuery'], function ($) {
 
    console.log('jQuery version:', $().jquery);

});
</script>

<?php
} else {
?>
    <!-- jQuery 2.1.4 -->
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?= $URL['core']['root']; ?>vendor/admin-lte/bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= $URL['core']['root']; ?>vendor/admin-lte/dist/js/app.min.js"></script>

    <?php
      foreach($VIEW['script'] as $key => $var) {
        include($var . $key);
      }
    ?>
  </body>
</html>
<?php
}
?>
