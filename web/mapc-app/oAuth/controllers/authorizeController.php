<?php
if(!defined("__MAPC__")) { exit(); }

include PROC_PATH . 'proc.autoload.php';

use Mapc\oAuth\oAuth;

$server = oAuth::setConfig();


$request = OAuth2\Request::createFromGlobals();
$response = new OAuth2\Response();

// validate the authorize request
if (!$server->validateAuthorizeRequest($request, $response)) {
    $response->send();
    die;
}

$is_authorized = true;
$server->handleAuthorizeRequest($request, $response, $is_authorized);
if ($is_authorized) {
    $code = substr($response->getHttpHeader('Location'), strpos($response->getHttpHeader('Location'), 'code=')+5, 40);
    exit("SUCCESS! Authorization Code: $code");
}
$response->send();