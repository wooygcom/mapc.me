<!DOCTYPE html>
<html>
    <head>
        <?php
            foreach($VIEW['headhook'] as $key => $var) {
                include($var . $key);
            }
        ?>

        <link rel="stylesheet" href="<?= $URL['core']['root']; ?>vendor/bootstrap/dist/css/bootstrap.min.css">

        <style type="text/css">
            body {
                padding-top: 58px;
            }
            .credit {
                text-align: center;
            }
            .col-lg-4 {
                padding-top: 10px;
            }
            .dropdown:hover .dropdown-menu {
                display: block;
            }
        </style>
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
    <header class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?= $URL['core']['main']; ?>"><?= $CONFIG['meta']['title']; ?></a>
        </div>
        <div class="navbar-collapse collapse">

            <?= $VIEW['head']['menu']; ?>

            <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="<?= $VIEW['sign_in_out_link']; ?>"><?= $VIEW['sign_in_out']; ?></a></li>
            </ul>
        </div><!--/.nav-collapse -->
      </div>
    </header>


    <div class="container">

        <div class="col-lg-8">

<!-- 본문:H -->
<?php
    include($section_file);
?>
<!-- 본문:T -->

        </div>

            <div class="col-lg-4 panel panel-info" id="sidebar" role="navigation">

                <?= $VIEW['head']['menu_sub']; ?>

                <p>
                    <?php
                    if(is_array($VIEW['side1_files'])) {

                        foreach($VIEW['side1_files'] as $side1_file) {

                            if(is_file($side1_file)) {

                                include($side1_file);

                            }

                        }

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
          <a class="navbar-brand" href="<?= $URL['core']['main']; ?>"><?= $CONFIG['meta']['title']; ?></a>
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
                  <p class="navbar-text">Copyright © <?= $CONFIG['meta']['copyright']; ?></p>
              </li>
          </ul>
        </div>
      </div>
    </footer>

    <?php
      foreach($VIEW['script'] as $key => $var) {
        include($var . $key);
      }
    ?>

    </body>

</html>
