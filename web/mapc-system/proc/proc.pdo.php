<?php
if(!defined('__MAPC__')) { exit(); }

{ // BLOCK:db_setup:20121231:DB설정

    try {
        $dsn = $CONFIG['secure']['dbadapter'] . ":host=" . $CONFIG['secure']['dbhost'] . ";dbname=" . $CONFIG['secure']['dbname'] . ";port=3306;charset=utf8";
        $pdo = new PDO($dsn, $CONFIG['secure']['dbuser'], $CONFIG['secure']['dbpass']);
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

} // BLOCK

// this is it
