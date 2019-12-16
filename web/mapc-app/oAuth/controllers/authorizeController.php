<?php
if(!defined("__MAPC__")) { exit(); }

include_once PROC_PATH . 'proc.autoload.php';

use Mapc\oAuth\oAuth;

$server = oAuth::setConfig();
$request = OAuth2\Request::createFromGlobals();
$response = new OAuth2\Response();

$result = array(
    "status" => false,
    "code" => "",
    "msg" => "",
);

// validate the authorize request
if (!$server->validateAuthorizeRequest($request, $response)) {
    $result['msg'] = "validate the authorize request";
    echo json_encode($result);
    exit;
    // $response->send();
    // die;
}

$is_authorized = true;
$server->handleAuthorizeRequest($request, $response, $is_authorized);
if ($is_authorized) {
    $code = substr($response->getHttpHeader('Location'), strpos($response->getHttpHeader('Location'), 'code=')+5, 40);

    $result['status'] = true;
    $result['code'] = $code;
    echo json_encode($result);
    exit;
    // exit("SUCCESS! Authorization Code: $code");
}
// $response->send();