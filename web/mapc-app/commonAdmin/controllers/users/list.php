<?php
if(!defined("__MAPC__")) { exit(); }

include(PROC_PATH   . 'proc.autoload.php'); // Mapc 내부 패키지 불러오기 위해서
include(VENDOR_PATH . 'autoload.php'); // compoesr 패키지 불러오기 위해서

use Mapc\CommonAdmin\UsersAdmin as UsersAdmin;

$db   = include(PROC_PATH . 'proc.db.php');

$user = new UsersAdmin(['db' => $db, 'table' => 'mc_user_info']);

// this is it
