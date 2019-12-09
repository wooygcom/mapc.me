<?php
if(!defined('__MAPC__')) { exit(); }

use \RedBeanPHP\R;

{ // BLOCK:db_setup:20121231:DB설정

    global $CONFIG;

    R::ext('xdispense', function( $type ){ 
        return R::getRedBean()->dispense( $type ); 
    });

    R::setup( $CONFIG['secure']['dbadapter'] . ':host=' . $CONFIG['secure']['dbhost'] . ';dbname=' . $CONFIG['secure']['dbname'], $CONFIG['secure']['dbuser'], $CONFIG['secure']['dbpass'] );

} // BLOCK

// this is it
