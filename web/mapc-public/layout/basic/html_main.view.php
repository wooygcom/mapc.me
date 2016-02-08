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


    <div class="container theme-showcase" role="main">

    <!-- 본문:H -->
    <?= $VIEW['content']; ?>
    <!-- 본문:T -->

    </div>


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
