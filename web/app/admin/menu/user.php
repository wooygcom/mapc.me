<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 페이지 설명
 */

require(INIT_PATH.'init.db.php');
{ // Model : Head

} // Model : Tail

// ======================================================================

{ // View : Head

    $section_file = $PATH['mapc']['root'] . 'view/basic/html_message.view.php';
	include_once(PROC_PATH . 'publish.proc.php');

} // View : Tail

// end of file
