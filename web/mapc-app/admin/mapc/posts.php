<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 글목록
 */

require(INIT_PATH.'init.admin.php');
{ // Model : Head

    $VIEW += include(MODULE_PATH . 'mapc/posts.php');
    unset($return);

    $VIEW['_paging']['url'] = $URL['core']['root'] . 'admin-mapc/posts/';

} // Model : Tail

// end of file
