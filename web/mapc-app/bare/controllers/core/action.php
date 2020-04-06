<?php
if(!defined("__MAPC__")) { exit(); }

include(PROC_PATH   . 'proc.exec.php');
include(VENDOR_PATH . 'autoload.php'); // compoesr 패키지 불러오기 위해서
include(SYSTEM_PATH . 'library/some-library.php');

use Mapc\Common\Users;

$obj_users = new Users;

// this is it
