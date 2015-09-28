<?php
if (isset($_GET["locale"])) {
	$locale = $_GET["locale"];
} else if (isset($_SESSION["locale"])) {
	$locale = $_SESSION["locale"];
} else {
	$locale = "ko_KR";
}
 
putenv("LANG=" . $locale);
setlocale(LC_ALL, $locale);

$domain = "messages";
bindtextdomain($domain, SITE_PATH . "locale/");
bind_textdomain_codeset($domain, 'UTF-8');

textdomain($domain);

// this is it
