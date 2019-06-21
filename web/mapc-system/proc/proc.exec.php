<?php
/**
 *
 * Form값 처리시 CSRF값 비교(보안)
 *
 */
if(!defined('__MAPC__')) { exit(); }

include(SYSTEM_PATH . 'library/security_arguments.php');

/*
$_GET  = security_arguments($_GET);
$_POST = security_arguments($_POST);
*/

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
