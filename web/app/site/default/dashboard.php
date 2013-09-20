<?php
if(!defined('__MAPC__')) { exit(); }

require(INIT_PATH . 'common.head.init.php');
{ // MODEL : Start

	$section_file['dashboard'] = $PATH['core']['skin'] . 'basic/dashboard.view.php';
	$section_data['dashboard']['message']		= 'Hello, world';
	$section_data['dashboard']['message_link']	= 'http://wooyg.com/';

} // MODEL : Finish
require(INIT_PATH . 'common.tail.init.php');

{ // View : Start

	$publish_data['layout_path'] = LAYOUT_PATH . $CONFIG['layout'] . '/';
	include_once(PROC_PATH . 'publish.proc.php');

} // View : Finish

// this is it
