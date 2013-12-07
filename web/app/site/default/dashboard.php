<?php
if(!defined('__MAPC__')) { exit(); }

require(INIT_PATH . 'init.head.php');
{ // MODEL : Start

} // MODEL : Finish
require(INIT_PATH . 'init.tail.php');

{ // View : Start

	$section_file = $PATH['core']['skin'] . 'basic/dashboard.view.php';
	$view['dashboard']['message']		= 'Hello, world';
	$view['dashboard']['message_link']	= 'http://wooyg.com/';
	include_once(PROC_PATH . 'publish.proc.php');

} // View : Finish

// this is it
