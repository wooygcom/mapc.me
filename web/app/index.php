<?php
define('__MAPC__', true);

// 필요할 경우 원하는 site환경설정 파일을 만들고 include하면 됨 (site.news.php, site.bbs.php)
$TEMP_SITE_FILE = 'site.mapcme_cms.php';


if(is_file($TEMP_SITE_FILE)) {
	include_once($TEMP_SITE_FILE);
} else {
	include_once('site.default.php');
}	

// end of file
