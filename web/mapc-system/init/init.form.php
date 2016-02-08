<?php
if(!defined('__MAPC__')) { exit(); }

require_once(INIT_PATH . 'init.core.php');
require_once(INIT_PATH . 'init.db.php');

{ // BLOCK:init:20121231

    if(! empty($_POST) && ($_POST['_csrf'] != $_SESSION['csrf']) ) {

        header('HTTP/1.0 401 Unauthorized');
        echo 'CSRF Error';
        exit();

    } else {

        $_SESSION['csrf'] = hash($CONFIG_SECRET['encrypt_method'], $_SERVER['REMOTE_ADDR'] . $CONFIG_SECRET['pass_key'] . date('YmdHis'));

    }

} // BLOCK

// this is it
