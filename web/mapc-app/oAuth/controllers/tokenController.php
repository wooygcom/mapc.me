<?php
if(!defined("__MAPC__")) { exit(); }

include PROC_PATH . 'proc.autoload.php';

use Mapc\oAuth\oAuth;

$server = oAuth::setConfig();

$server->handleTokenRequest(OAuth2\Request::createFromGlobals())->send();