Controllers
==================================================

controllers/package.php
--------------------------------------------------
```
<?php
{ // BLOCK:proc:20190617:프로시저불러오기

} // BLOCK

{ // BLOCK:get_controller:20150825:컨트롤러 불러오기

    /**
     *
     * Get Controller
     *
     */
    include(__DIR__ . '/controllers/' . $ROUTES['module'] . 'Controller.php');

} // BLOCK

{ // BLOCK:publish:20150825:출력처리

    /**
     *
     * Get VIEW file and publish
     *
     */
    include(__DIR__ . '/views/' . $ROUTES['module'] . 'View.php');

} // BLOCK
```

controllers/package/module.php
--------------------------------------------------
```
<?php
if(!defined("__MAPC__")) { exit(); }

include($ROUTES['callback'] . '.php');

// this is it
```

Autoload
--------------------------------------------------
include_once(SYSTEM_PATH . 'proc/proc.autoload.php');


DB접근이 필요할 때
--------------------------------------------------
$db   = include(PROC_PATH . 'proc.db.php');
$user = new Users(['db' => $db]);


Controller 가져오기
--------------------------------------------------
include APP_PATH . 'common/models/UsersModel.php';
use Mapc\Common\Users as Users;


TODO
--------------------------------------------------
APP/controlloer, models, views를 autoload에서 불러올 수 있게...
