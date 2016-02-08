<html>
	<head>
		<title>iMinho.com</title>
		<meta name="keywords" content="자료관리, 일기, 내 자료, CMS, ownCloud">
		<meta charset="utf-8" />
		<base target="subpage" />
		<style type="text/css">
			.container	{ height:50px; line-height:20px; width:100%; margin:0px auto; background-color:#000; }
			.navi	{ text-align:center; width:80%; float:left; font-size:12px; color:yellow; background-color:#000; padding:7px; }
			.userinfo	{ width:150px; float:left; font-size:12px; color:#fff; background-color:#000; padding:7px; text-align:right; }
			a:link		{text-decoration: none; color: #ccc;}
			a:visited	{text-decoration: none; color: #ccc;}
			a:active	{text-decoration: none; color: #ccc;}
			a:hover	{text-decoration: underline; color: #aff;}
		</style>
	</head>
	<body>

<?php
$pagea = $_REQUEST['page'];

switch($pagea) {
	case 'wooyg.com':
		$title = "WooYG.com";
		break;
	case 'iminho.com':
	default:
		$title = "iMinHo.com";
		break;
}
?>

		<div class="container">
			<div class="navi">
				<a href="<?= $URL['core']['root']; ?>link/sub/&page=<?= $pagea; ?>"><?= $title; ?></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				[ Ctrl + D ]
			</div>
			<div class="userinfo">
			</div>
		</div>

	</body>
</html>

<?php
exit;
?>
