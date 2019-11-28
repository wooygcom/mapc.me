<?php
if(!defined("__MAPC__")) { exit(); }

include(PROC_PATH   . 'proc.autoload.php'); // Mapc 내부 패키지 불러오기 위해서
include(VENDOR_PATH . 'autoload.php'); // compoesr 패키지 불러오기 위해서

use Mapc\CommonAdmin\UsersAdmin as UsersAdmin;

$db   = include(PROC_PATH . 'proc.db.php');

$user = new UsersAdmin(['db' => $db]);

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    // POST값이 들어오면 "실행"
    switch($_POST['_method']) {
        case 'post':
        case 'put':
        case 'patch':
        case 'delete':
        default:
            // 
            exit;
            break;
    }
}

// this is it