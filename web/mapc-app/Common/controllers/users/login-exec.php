<?php

include_once(SYSTEM_PATH . 'library/http_move.php');
include(APP_PATH  . 'Common/models/UsersModel.php');

// 권한체크 #WITY
if(!MODE_DEV && ! $_SESSION['SS_USR_ID']) {
    httpMove(200, ROOT_URL . 'smu/users/signin');
    exit;
}

use Mapc\Common\Users as Users;

$db   = include(PROC_PATH . 'proc.db.php');
$user = new Users(['db' => $db]);

/* #TODO
// oAuth 처리할 경우에만 아래 내용처리
// #TODO CONFIG에서 url설정하도록 바꿔야 됨
*/
$url = "http://175.196.104.2/web/mapc-public/oAuth";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, [
    'code' => $code,
    'client_id' => $_POST['user_email'],
    'client_secret' => $_POST['user_password'],
    'redirect_uri' => $redirect_uri,
    'grant_type' => 'client_credentials'
]);

curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$output = curl_exec($ch);
$info   = curl_getinfo($ch);
var_dump($output);

curl_close($ch);

//grant_type=client_credentials
// 새로등록
// 판올림
// 지우기(로그 남기고 temp 테이블로)

exit;

$reffererUrl = isset($_REQUEST['reffererUrl']) ? $_REQUEST['reffererUrl'] : ROOT_URL;

httpMove(200, $reffererUrl);

exit;

// this is it
