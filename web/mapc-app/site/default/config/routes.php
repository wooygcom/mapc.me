<?php
if(!defined('__MAPC__')) { exit(); }

{ // BLOCK:set_routes:20150807

    switch($ARGS['modl']) {
        case 'welcome':
            $ARGS['modl'] = 'home';
            $ARGS['page'] = 'index';
        default:
            // do nothing
            break;
    }

} // BLOCK

// end of file
