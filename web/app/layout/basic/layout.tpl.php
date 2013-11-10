<?php
/**
 * @param function mapc_file_skin_include($file_arr, $data_arr)
 */
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $publish_data['head']['title']; ?></title>
		<?php
			if(is_array($publish_data['head']['css'])) {

				foreach($publish_data['head']['css'] as $file => $dir) {

					echo '<link href="', $dir, $file, '" rel="stylesheet" type="text/css" media="screen" />', "\n";

				}

			}

			if(is_array($publish_data['head']['js'])) {

				foreach($publish_data['head']['js'] as $file => $dir) {

					echo '<script type="text/javascript" src="', $dir, $file, '"></script>', "\n";

				}

			}
		?>
		<?php if(!empty($head_file)) { mapc_file_skin_include($head_file, $head_file_data); } ?>
	    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style type="text/css">
			body {
				padding-top: 60px;
			}
			.col-md-8 {
				padding: 0px 10px 0px 0px;
			}
			.credit {
				text-align: center;
				padding-top: 10px;
			}
			#footer {
				margin-top:35px;
			}

			.panel-info {
				padding:10px;
			}
		</style>
	</head>
	<body>

    <!-- Fixed navbar -->
    <header class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?= $URL['core']['root']; ?>">MapC.me CMS</a>
        </div>
        <div class="navbar-collapse collapse">

<?= $publish_data['head']['menu']; ?>

          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="<?= $URL['user']['root'] . '&core_page=login'; ?>">로그인</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </header>


    <div class="container">

        <div class="col-md-8">

<!-- 본문:H -->
<?php
	include($section_file);
?>
<!-- 본문:T -->

        </div>

        <div class="col-md-4 panel panel-info" id="sidebar" role="navigation">

<?= $publish_data['head']['menu_sub']; ?>

        </div><!--/.panel -->

    </div><!--/.container-->


    <div id="footer" class="navbar-inverse">
      <div class="container">
        <p class="text-muted credit">Copyright OOO</p>
      </div>
    </div>

	</body>

</html>
