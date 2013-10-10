<html>
<head>
<script src="http:////ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
function blink(){
    $('.blink_image').delay(1500).fadeTo(100,0).delay(100).fadeTo(100,1, blink);
}

$(document).ready(function() {
    blink();
});
</script>
</head>
<body>
<img src='imagefile.png' class='blink_image' />
</body>
</html>
