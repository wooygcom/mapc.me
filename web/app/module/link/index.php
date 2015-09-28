<?php
	$req_gotourl = (isset($_REQUEST['goto'])) ? $_REQUEST['goto'] : 'about:blank';
?>

<html>
	<head>
		<title>WooYG.com - Ctrl+D</title>
	</head>
	<frameset rows="35,*" frameborder="no" border="0">
		<frame src="./link/top/" name="TopFrm" scrolling="no" marginwidth="0"  marginheight="0">
		<frame src="http://<?php echo $req_gotourl; ?>" id="subpage" name="subpage" marginwidth="0" marginheight="0">
	</frameset>
</html>
