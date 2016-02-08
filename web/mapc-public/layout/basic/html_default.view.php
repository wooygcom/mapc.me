<?php
/**
 * @version 20151005
 */

{ // BLOCK:init:20151129

    include_once(LIBRARY_PATH . 'mapc/file_skin_include.func.php');

} // BLOCK

{ // BLOCK:bare_code:20151005
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
    <?= $VIEW['content']; ?>
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

{ // BLOCK:option_code:20151005
/*
    <!-- Menu : H -->
    echo include(__DIR__ . '/menu.view.php');
    <!-- Menu : F -->
*/

/*
  <!-- image url -->
  <?= $URL['layout']; ?>
/*
  <!-- link to main -->
  <a class="navbar-brand" href="<?= $URL['core']['main']; ?>"><?= $VIEW['meta']['title']; ?></a>
*/

/*
  <!-- user status(sign in or out) -->
  <a href="<?= $VIEW['sign_in_out_link']; ?>"><?= $VIEW['sign_in_out']; ?></a>
 */

/*
  <!-- popup : head -->
  <?php
    if(! empty($VIEW['popup']) && ! $_COOKIE['event_popup']) {
  ?>

    <a href="<?= $VIEW['popup']['link']; ?>" target="_blank">
      <img src="<?= $URL['core']['root']; ?>core/file/&file=popup/<?= $VIEW['popup']['popup_banner']; ?>&hash=<?= hash('md5', filesize(DATA_PATH . 'popup/' . $VIEW['popup']['popup_banner'])); ?>" alt="<?= $VIEW['popup']['title']; ?>" />
    </a>

    <input type="checkbox" class="popup_close_today" />
    <label for="close_today"><?= _('1일간 열지 않음'); ?></label>
    <button type="button" class="btn_close_popup"></button>

    <script>
      function notice_setCookie( name, value, expiredays ){ // Cookie 값 확인 function
        var todayDate = new Date();
        todayDate.setDate( todayDate.getDate() + expiredays );
        document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
      }

      $( ".btn_close_popup" ).click(function() {
        $( ".event_popup" ).hide( "fold", 1000 );
      });
      $( ".popup_close_today").click(function() {
        notice_setCookie( "event_popup", "done" , 1);
        $(".btn_close_popup").click();
      });
    </script>

  <?php
    }
  ?>
  <!-- popup : tail -->
 */
} // BLOCK
?>
<!DOCTYPE html>
<html>
    <head>
        <?php
            foreach($VIEW['headhook'] as $key => $var) {
                include($var . $key);
            }
        ?>
        <link rel="icon" href="/wygoing/mapc.me.full/web/mapc-public/favicon.ico">

        <link rel="stylesheet" href="<?= $URL['core']['root']; ?>vendor/bootstrap/dist/css/bootstrap.min.css">

        <link rel="stylesheet" href="<?= $URL['layout']; ?>css/main.css">

        <meta charset="utf-8">
    </head>
    <body class="pre-scrollable metro">

    <!-- banner : head -->
    <?php
      if(! empty($VIEW['popup']) && ! $_COOKIE['event_popup']) {
    ?>
    <div id="wrap" class="event_popup" style="text-align:center; padding:10px;">

      <div class="banner">
        <div>
          <a href="<?= $VIEW['popup']['link']; ?>" target="_blank">
            <img src="<?= $URL['core']['root']; ?>core/file/&file=popup/<?= $VIEW['popup']['popup_banner']; ?>&hash=<?= hash('md5', filesize(DATA_PATH . 'popup/' . $VIEW['popup']['popup_banner'])); ?>" alt="<?= $VIEW['popup']['title']; ?>" />
          </a>
        </div>
        <div class="btn_close">
          <input type="checkbox" id="close_today" />
          <label for="close_today">1일간 열지 않음</label>
          <button type="button" class="glyphicon glyphicon-remove btn_close_popup"></button>
        </div>
      </div>

      </div>

    </div>
    <script>
      function notice_setCookie( name, value, expiredays ){ //Cookie 값 확인 function
        var todayDate = new Date();
        todayDate.setDate( todayDate.getDate() + expiredays );
        document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
      }

      $( ".btn_close_popup" ).click(function() {
        $( ".event_popup" ).hide( "fold", 1000 );
      });
      $( "#close_today").click(function() {
        notice_setCookie( "event_popup", "done" , 1);
        $(".btn_close_popup").click();
      });
    </script>
    <?php
      }
    ?>
    <!-- banner : tail -->

    <!-- Fixed navbar -->
    <header class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?= $URL['core']['main']; ?>"><?= $VIEW['meta']['title']; ?></a>
        </div>
        <div class="navbar-collapse collapse">

            <?php
                echo include(__DIR__ . '/menu.view.php');
            ?>

            <ul class="nav navbar-nav navbar-right">
              <?php if(! empty($VIEW['sign_in_out']) && ! empty($VIEW['user_profile'])) { ?>
                <li class="active"><a href="<?= $VIEW['sign_in_out_link']; ?>"><?= $VIEW['sign_in_out']; ?></a></li>
                <li class="active"><a href="<?= $VIEW['user_profile_link']; ?>"><?= $VIEW['user_profile']; ?></a></li>
              <?php } ?>
            </ul>
        </div><!--/.nav-collapse -->
      </div>
    </header>


    <div class="container">

        <div class="col-lg-8">

<p>
    <!-- 본문:H -->
    <?= $VIEW['content']; ?>
    <!-- 본문:T -->
</p>
        </div>

        <div class="col-lg-4 panel panel-info" id="sidebar" role="navigation">

            <p>
                <?php
                    foreach($VIEW['_sidebar'] as $key => $var) {
                        mapc_file_skin_include($PATH['_sidebar'][$key], $VIEW['_sidebar'][$key]);
                    }
                ?>
            </p>

        </div><!--/.panel -->

    </div><!--/.container-->


    <footer class="navbar navbar-default" role="navigation">
      <div class="container">
        <div class="navbar-footer">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?= $URL['core']['main']; ?>"><?= $VIEW['meta']['title']; ?></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
              <?php
                  if(! empty($site_info)) {
              ?>
              <li>
                  <?= $site_info; ?>
              </li>
              <?php
                  }
              ?>
              <li>
                  <p class="navbar-text">Copyright © <?= $VIEW['meta']['copyright']; ?></p>
              </li>
          </ul>
        </div>
      </div>
    </footer>

    <script src="<?= $URL['core']['root']; ?>vendor/jquery/dist/jquery.min.js"></script>
    <script src="<?= $URL['core']['root']; ?>vendor/bootstrap/dist/js/bootstrap.min.js"></script>

    <?php
      foreach($VIEW['script'] as $key => $var) {
        include($var . $key);
      }
    ?>

    </body>

</html>
