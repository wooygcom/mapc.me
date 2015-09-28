<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 글목록
 */

require(INIT_PATH.'init.admin.php');
{ // Model : Head

    include(MODULE_PATH . 'mapc/list.php');
    $URL['mapc']['view'] = $URL['core']['root'] . 'admin-mapc/view/';

} // Model : Tail

// end of file
