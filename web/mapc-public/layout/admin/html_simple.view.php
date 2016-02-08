<?php
/**
 * @version 20151002.1
 */

{ // BLOCK:bare_code:20150918
/*
<?php
    if(! empty($VIEW['url'])) {
      $alert_code = '<script>alert("' . $VIEW['message'] . '");</script>' .
          '<meta http-equiv="refresh" content="0;url=' . $VIEW['url'] . '" />';
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <?= $alert_code; ?>
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
  </body>
</html>
*/
} // BLOCK

    if(! empty($VIEW['url'])) {
        $alert_code = '<script>alert("' . $VIEW['message'] . '");</script>' .
            '<meta http-equiv="refresh" content="0;url=' . $VIEW['url'] . '" />';
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <?= $alert_code; ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $VIEW['meta']['title']; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link rel="stylesheet" href="<?= $URL['core']['root']; ?>vendor/admin-lte/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= $URL['core']['root']; ?>vendor/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons 2.0.0 -->
    <link rel="stylesheet" href="<?= $URL['core']['root']; ?>ionic/release/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= $URL['core']['root']; ?>vendor/admin-lte/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= $URL['core']['root']; ?>vendor/admin-lte/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">

  <!-- 본문:H -->
  <?php
      if($VIEW['message']) {

          echo $VIEW['message'];

      } else {

          include($VIEW['section_file']);

      }
  ?>
  <!-- 본문:T -->

    <!-- jQuery 2.1.4 -->
    <script src="<?= $URL['core']['root']; ?>vendor/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.4 -->
    <script src="<?= $URL['core']['root']; ?>vendor/admin-lte/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?= $URL['core']['root']; ?>vendor/admin-lte/plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
