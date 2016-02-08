<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 글목록
 */

require(INIT_PATH.'init.admin.php');
{ // Model : Head

    include(MODULE_PATH . 'mapc/edit.php');;
    $VIEW['action_url'] = $URL['core']['root'] . 'admin-mapc/edit_act/';

} // Model : Tail

// end of file
