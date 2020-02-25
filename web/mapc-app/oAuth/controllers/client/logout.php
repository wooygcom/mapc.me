<?php
if(!defined("__MAPC__")) { exit(); }
include VENDOR_PATH . 'autoload.php';

// access_token
$v['access_token'] = $_SESSION['access_token'];

// user info
$v['userInfos'] = $_SESSION['userInfos'];
