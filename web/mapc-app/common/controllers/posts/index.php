<?php
if(!defined("__MAPC__")) { exit(); }

include VENDOR_PATH . 'autoload.php';
include APP_PATH  . 'common/models/PostsModel.php';
use Mapc\Common\Posts as Posts;

$db    = include(PROC_PATH . 'proc.db.php');
$posts = new Posts(['db' => $db]);

$v['userList'] = $posts->show();

// this is it
