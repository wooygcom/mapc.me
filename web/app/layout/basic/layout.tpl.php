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
				padding-bottom: 40px;
			}
		</style>
	</head>
	<body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?= $URL['core']['root']; ?>">MapC.me</a>
        </div>
        <div class="navbar-collapse collapse">

<?= $publish_data['head']['menu']; ?>

          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="#login">로그인</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>


    <div class="container">

        <div class="col-xs-12 col-md-8">
            
<?php if(!empty($section_file)) { mapc_file_skin_include($section_file, $section_data); } ?>

        </div>

        <div class="col-xs-6 col-md-4" id="sidebar" role="navigation">

<?= $publish_data['head']['menu_sub']; ?>

        </div><!--/.well -->

    </div><!--/.container-->


	</body>

</html>