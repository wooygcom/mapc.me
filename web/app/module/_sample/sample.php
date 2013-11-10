<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 페이지 설명
 */

require(INIT_PATH.'common.head.init.php');
{ // Model : Head

} // Model : Tail
require(INIT_PATH.'common.tail.init.php');

// ======================================================================

{ // View : Head

    $section_file = $PATH['mapc']['root'] . 'view/basic/list.view.php';
	include_once(PROC_PATH . 'publish.proc.php');

} // View : Tail

// end of file
