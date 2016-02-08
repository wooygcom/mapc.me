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
        <?php
            foreach($VIEW['headhook'] as $key => $var) {
                include($var . $key);
            }
        ?>
        <?= $alert_code; ?>
        <link href="<?= $URL['core']['root']; ?>vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen" />
        <meta charset="utf-8">
    </head>
    <body class="pre-scrollable metro">

        <div class="col-md-12 container fill">

<!-- 본문:H -->
<?php
    if($VIEW['message']) {

        echo $VIEW['message'];

    } else {

        include($VIEW['section_file']);

    }
?>
<!-- 본문:T -->

        </div>

    </body>

</html>
