<?php
if(!defined("__MAPC__")) { exit(); }

{ // 입력값 처리

    $name  = $_POST['name'];
    $email = $_POST['email'];
    $pwd   = $_POST['pwd'];
    $pwd_retype = $_POST['pwd_retype'];
    $memo  = $_POST['memo'];

    if($pwd != $pwd_retype) {
        // #TODO 암호가 맞지 않음 에러표시
    }

} // 입력값 처리

include(PROC_PATH   . 'proc.autoload.php'); // Mapc 내부 패키지 불러오기 위해서
include(VENDOR_PATH . 'autoload.php'); // compoesr 패키지 불러오기 위해서

use Mapc\Common\Users;

$db   = include(PROC_PATH . 'proc.db.php');
$user = new Users(['db' => $db, 'table' => 'mc_user_info']);

$user->vars->user_name  = $name;
$user->vars->user_id = $email;
$user->vars->passwd   = $pwd;
$user->vars->memo  = $memo;

$id = $user->create($user->vars);

if($id) {
    $return['result'] = 'success';
} else {
    $return['result'] = 'fail';
}

return json_encode($return);

exit;

// this is it
