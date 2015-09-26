<?php
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

        include($section_file);

    }
?>
<!-- 본문:T -->

        </div>

    </body>

</html>
