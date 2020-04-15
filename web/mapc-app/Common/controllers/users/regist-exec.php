<?php
use Mapc\Common\Users;

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

{ // BLOCK:proc:선처리:20200406

    include(PROC_PATH . 'proc.exec.php');
    include(PROC_PATH . 'proc.autoload.php'); // compoesr 패키지 불러오기 위해서

    $db = include(PROC_PATH . 'proc.db.php');

    $objUser = new Users(['db' => $db, 'table' => 'mc_user_info']);

} // BLOCK

$objUser->vars->user_name  = $name;
$objUser->vars->user_id = $email;
$objUser->vars->passwd   = $pwd;
$objUser->vars->memo  = $memo;

$id = $objUser->create($objUser->vars);

if($id) {
    $return['result'] = 'success';
} else {
    $return['result'] = 'fail';
}
print_r($return);
return json_encode($return);

exit;

// this is it
