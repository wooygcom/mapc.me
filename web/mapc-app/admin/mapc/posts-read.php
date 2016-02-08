<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 글목록
 */

require(INIT_PATH.'init.admin.php');
{ // Model : Head

    include(MODULE_PATH . 'mapc/posts-read.php');
    unset($return);
$PATH['section'] = $PATH['view']['module'];
} // Model : Tail

// end of file
