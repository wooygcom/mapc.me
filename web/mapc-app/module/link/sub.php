<html>
    <title>WooYG.com</title>
    <meta charset="utf-8">
	<body>
		<center>
<?php
$pagea = $_REQUEST['page'];
?>

<?php
switch($pagea) {
case 'iminho.com':
    echo '<h1>IMINHO.com</h1>';
    break;
default:
    echo '<a href="http://주네스.한국/">주네스.한국</a>';
	break;
}
?>
		</center>
	</body>
</html>

<?php
exit;
?>
