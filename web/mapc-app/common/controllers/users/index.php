<?php
if(!defined("__MAPC__")) { exit(); }

include VENDOR_PATH . 'autoload.php';
include APP_PATH  . 'Common/models/UsersModel.php';
use Mapc\Common\Users as Users;

OAuth2\Autoloader::register();

$db   = include(PROC_PATH . 'proc.db.php');
$users = new Users(['db' => $db, 'table' => 'mc_user_info']);

$v['userList'] = $users->search();

// this is it
