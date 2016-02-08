<?php
	$req_gotourl = (isset($ARGS['goto'])) ? urldecode($ARGS['goto']) : 'http://www.lazada.com.ph/korea-cosmetics/';
?>

<html>
	<head>
		<title>iMiNHO.com - Ctrl+D</title>
	</head>
	<frameset rows="35,*" frameborder="no" border="0">
		<frame src="<?= $URL['core']['root']; ?>link/top/" name="TopFrm" scrolling="no" marginwidth="0"  marginheight="0">
		<frame src="<?= $req_gotourl; ?>" id="subpage" name="subpage" marginwidth="0" marginheight="0">
	</frameset>
</html>

<?php
exit;
?>