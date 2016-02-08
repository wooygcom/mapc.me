<?php
if(!defined('__MAPC__')) { exit(); }

require(INIT_PATH . 'init.admin.php');
{ // MODEL : Start

} // MODEL : Finish


{ // View : Start

    $section_file = PUBLIC_PATH . 'site/' . SITE_CODE . '/admin/dashboard.view.php';
    if(! is_file($section_file)) { unset($section_file); }

} // View : Finish

// this is it
