<?php
if(!defined('__MAPC__')) { exit(); }

use \RedBeanPHP\R;

$r = new R;

{ // BLOCK:db_setup:20121231:DB설정

    global $CONFIG;

    $r::ext('xdispense', function( $type ){ 
        return R::getRedBean()->dispense( $type ); 
    });

	$r::setup( $CONFIG['dbadapter'] . ':host=' . $CONFIG['dbhost'] . ';dbname=' . $CONFIG['dbname'], $CONFIG['dbuser'], $CONFIG['dbpass'] );

	return $r;

} // BLOCK

// this is it
