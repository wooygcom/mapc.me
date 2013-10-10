<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>select demo</title>
<style>
p {
color: blue;
}
div {
color: red;
}
</style>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
</head>
<body>
<p>Click and drag the mouse to select text in the inputs.</p>
<input type="text" value="Some text">
<input type="text" value="to test on">
<div></div>
<script>
$( ":input" ).select(function() {
$( "div" ).text( "Something was selected" ).show().fadeOut( 1000 );
});
</script>
</body>
</html>