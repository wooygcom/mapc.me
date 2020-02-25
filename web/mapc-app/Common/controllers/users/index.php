<?php
if(!defined("__MAPC__")) { exit(); }

include PROC_PATH . 'proc.autoload.php';
include PROC_PATH . 'proc.user.php';

use Mapc\Common\Users;

OAuth2\Autoloader::register();

$db   = include(PROC_PATH . 'proc.db.php');
$users = new Users(['table' => 'mc_user_info']);

$v['userList'] = $users->search(['user_id' => 'testclient']);

// this is it
