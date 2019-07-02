<?php
if(!defined('__MAPC__')) { exit(); }

// #TODO APP/controlloer, models, views를 autoload에서 불러올 수 있게...
session_start();

use Mapc\Common\User as MapcUser;

$user = new MapcUser;
$user->signin();
$v['user'] = $user;

// this is it
