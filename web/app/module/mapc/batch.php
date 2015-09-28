<?php
if(!defined('__MAPC__')) { exit(); }
/**
 * 일괄편집
 */

require(INIT_PATH.'init.db.php');
{ // Model : Head

} // Model : Tail

// ======================================================================

{ // View : Head

    $VIEW['head']['css']['jquery-ui.min.css'] = $URL['core']['root'] . 'res/jquery-ui/css/default/';
    $VIEW['head']['js']['jquery.min.js']      = $URL['core']['root'] . 'res/jquery/';
    $VIEW['head']['js']['jquery-ui.min.js']   = $URL['core']['root'] . 'res/jquery-ui/js/';

    $mapc_edit_mode = 'batch';

    $section_file = $PATH['module']['skin'] . '/edit.view.php';

} // View : Tail

// end of file
