<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 페이지 설명
 */

require(INIT_PATH.'init.head.php');
{ // Model : Head

} // Model : Tail
require(INIT_PATH.'init.tail.php');

// ======================================================================

{ // View : Head

    $section_file = $PATH['mapc']['root'] . 'view/basic/list.view.php';
	include_once(PROC_PATH . 'publish.proc.php');

} // View : Tail

// end of file
