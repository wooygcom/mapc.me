Controllers
==================================================

작동방식
--------------------------------------------------

1. config/routes.php의 설정에 따라
  controllers/packageController.php에서
  controllers/package/module.php 호출
2. package전체에서 사용하는 선처리, 후처리 할 것이 있으면 packageController.php에서
  module안에서만 필요한건 module.php에서 처리


controllers/packageController.php
--------------------------------------------------
```
<?php
if(!defined("__MAPC__")) { exit(); }

include($ROUTES['callback'] . '.php');

// this is it
```

controllers/package/module.php
--------------------------------------------------
```
<?php
if(!defined("__MAPC__")) { exit(); }

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    // POST값이 들어오면 "실행"
    switch($_POST['_method']) {
        case 'post':
        case 'put':
        case 'patch':
        case 'delete':
        default:
            // 
            break;
    }
}

// this is it
```

Autoload
--------------------------------------------------
include(VENDOR_PATH . 'autoload.php'); // compoesr 패키지 불러오기 위해서
include(PROC_PATH   . 'proc.autoload.php'); // Mapc 내부 패키지 불러오기 위해서


DB접근이 필요할 때
--------------------------------------------------
$db   = include(PROC_PATH . 'proc.db.php');
$user = new Users(['db' => $db, 'table' => $table]);


모델클래스 가져오기(아래 둘 중 하나 선택)
--------------------------------------------------
1. include APP_PATH . 'common/models/UsersModel.php';
2. use Mapc\Common\Users;

