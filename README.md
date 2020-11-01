# mapc.me

특징
-------------------------------------------------------------------------------

* Pure PHP

* MVC

* Easy update for site manager

* Fast running time


Installation1 (with docker-compose)
-------------------------------------------------------------------------------

1. 의존성도구 설치

    Composer, NPM, NPX 설치 ($ npm i -g npx)

2. Git 클론(최초 1회)
    ```
    $ git clone https://github.com/wooygcom/mapc.me.git
    ```

3. 필요한 패키지 설치

    ```
    $ cd MAPC_ME_ROOT/web
    $ composer update (또는 php composer.phar update)
    $ npm install
    $ npm run build
    ```

4. 서버만 실행할 때
    ```
    $ sudo docker-compose up -d
    ```

5. 추가로 설치할 경우(필요할 때만)
    ```
    npm install PACKAGE --save
    ```


접속
-------------------------------------------------------------------------------

1. 개발할 때의 접속주소
    http://접속주소/mapc.me/web/mapc-public/

2. 실 서버에서는 "mapc-public'이 웹루트가 되도록 설정할 것!!!(보안)


새로운 페이지 만드는 방법
-------------------------------------------------------------------------------

1. /my/diary/edit 라는 페이지를 만드려면

    1. mapc-app/ 디렉토리의 "bare" 디렉토리를 "my"라는 디렉토리로 복사하고
    2. "my/controllers 와 views 각 디렉토리 안의 index.php를 edit.php로 복사하면
    3. 설치된URL/my/diary/edit 로 접속 할 수 있다.

2. // #TODO 설명서 만들어야 됨


프로그램 구동절차
-------------------------------------------------------------------------------

0. //URL/[VENDOR]/[MODULE]/[ACTION] 로 접속 할 경우 벌어지는 일~
    (아래는 //URL/Common/posts/123/edit 으로 접속 할 경우를 예로 들었음)

1. /mapc-public/index.php
    1. 상수값 설정, 환경설정을 불러옴
        1. env에서 기본환경설정(디렉토리, URL설정) 불러옴
            어느 디렉토리에서 환경설정불러올지 설정할 수 있음
            기본은 config 이고 이걸 config.site 이런식으로 바꿀 수 있음
            여러가지 환경설정을 만들어두고 필요에 따라 바꿀 수 있음
        2. config(사이트별 특화된 환경설정), routes(Routes설정) 불러옴
            Common/config/routes.php 에서 Common/posts/123/edit([VENDOR]/[MODULE]/[ID]/[ACTION]) 순으로 Argument를 받게끔 설정됨

    2. 입력값(벤더, 모듈, 액션 등)에 따라서 필요한 파일 불러오기(다음장으로)
        /mapc-app/Common/index.php

2. /mapc-app/Common/index.php
    1. Controllers/PostsController.php 불러옴
    2. Views/PostsView.php 불러옴

3. 각각의 PostsController.php, PostsView.php
    1. PostsController(또는 View) 안에서 switch case 문을 사용해서 각 action을 프로그램해도 되고...
    2. posts/edit.php 불러오게 해도 됨
    3. 아래처럼
        1. Controller에서 전부 처리하게해도 되고
            PostsController.php
            switch($ROUTES['action']) {
                case 'edit':
            }
        2. 각각의 Action별로 나누고 불러오는 방식으로 해도 되고...
            include('posts/edit.php');


4. 실제 프로그램 영역
    Controller/posts/edit.php 에서 선처리!!!!! (array $v에 출력할 내용을 저장)
    View/posts/edit.php 에서 화면출력!!!!!
    전체에 같은 설정을 적용하려면 PostsView.php 에서 header 등 필요한 내용을 설정
    각각의 페이지에서 화면출력을 따로 설정하려면 posts/edit.php 에서 header나 footer등을 불러오게 하면 됨.


기본형태 - vendor
==================================================

vendor/index.php [1/2]
--------------------------------------------------

    * 일반적인 형태(vendor/Common/index.php)와 별다른 차이가 없으면

```
<?php
{ // BLOCK:get_common:20150825:Common/index.php 그대로 가져오기

    $rootDir = __DIR__;
    @include($rootDir . DS . '..' . DS . 'Common' . DS . 'index.php');

} // BLOCK

// this is it

```

vendor/index.php [2/2]
--------------------------------------------------

    * vendor/index.php를 처음 만들 때는 [1/2] 또는 [2/2]를 복사 붙여넣기 하면 됨
    * vendor/Common/index.php(일반적인형태)와 다른 형태로 만들고 싶을때 사용

```
<?php
{ // BLOCK:proc:20191204:선처리

    $rootDir = $rootDir ? $rootDir : __DIR__;

} // BLOCK

{ // BLOCK:get_controller:20150825:컨트롤러 불러오기

    /**
     *
     * Get Controller...
     *
     */
    $v = [];
    @include($rootDir . '/controllers/' . $ROUTES['module'] . 'Controller.php');

} // BLOCK

{ // BLOCK:publish:20150825:출력처리

    /**
     *
     * Get VIEW file and publish
     *
     */
    // 보안을 위해 CONFIG에서 필요한 값을 제외한 모든 환경설정값 지우기
    $v['url']  = $CONFIG['url'];
    $v['menu'] = $CONFIG['menu'];
    $v['site'] = $CONFIG['site'];
    unset($CONFIG);
    @include($rootDir . '/views/' . $ROUTES['module'] . 'View.php');

} // BLOCK

// this is it

```

기본형태 - Controllers
==================================================

작동방식
--------------------------------------------------

1. config/routes.php의 설정에 따라
  controllers/packageController.php에서
  controllers/package/module.php 호출
2. package전체에서 사용하는 선처리, 후처리 할 것이 있으면 packageController.php에서
  module안에서만 필요한건 module.php에서 처리



vendor/controllers/packageController.php
--------------------------------------------------
```
<?php
if(!defined("__MAPC__")) { exit(); }

include($ROUTES['callback'] . '.php');

// this is it
```

vendor/controllers/package/module.php
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
include(PROC_PATH . 'proc.autoload.php'); // Mapc 내부 패키지 불러오기 위해서


DB접근이 필요할 때
--------------------------------------------------
$db   = include(PROC_PATH . 'proc.db.php');
$user = new Users(['db' => $db, 'table' => $table]);


모델클래스 가져오기(1번 방식 추천)
--------------------------------------------------
1. use Mapc\Common\Users;
2. include APP_PATH . 'Common/models/UsersModel.php';

### 실행화일일 경우
include(PROC_PATH . 'proc.exec.php');


기본형태 - Models
==================================================

vendor/models/MyModel.php
--------------------------------------------------
```
<?php
namespace Mapc\Common;

use Mapc\Common\Crud;

/**
 * Bare Model
 * @version 0.1
 */
class Bare {

    public $id;
    public $vars;

} // class

// this is it
```


기본형태 - Views
==================================================

Form
--------------------------------------------------

### 기본형태

1. 기본
```
include($ROUTES['callback'] . '.php');
```

2. 단순 : moduleView.php에서 모두처리, 스크립트 처리가 필요없는 프로그램에서만 사용, 1번 기본형 추천
```
<?php
/**
 *
 * View
 *
 * @version 0.1
 *
 */
$layout = 'core';
include(LAYOUT_PATH . $layout . DS . 'head.php');
include(LAYOUT_PATH . $layout . DS . 'header.php');
?>

내용

<?php
include(LAYOUT_PATH . $layout . DS . 'footer.php');
include(LAYOUT_PATH . $layout . DS . 'foot.php');

// this is it
```


### 스크립트 추가할 때

```
$v['head']['extension'] = <<< EOT
<!-- include libraries(jQuery, bootstrap) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
EOT;
```

### 스크립트 추가하고 변수 넣을 때
$v['header']['extension'] = sprintf($v['header']['extension'], ROOT_URL);


### 폼 입력할 때 기본형태
<!-- form:#formv1 -->
<form method="post" action="./" enctype="multipart/form-data">
    <input type="hidden" name="_csrf" value="<?= $_SESSION['csrf']; ?>" />
    <input type="hidden" name="_method" value="update" /><!-- POST, PUT, PATCH, DELETE -->
    <input type="hidden" name="content_type" value="<?= $ROUTES['action'] ? $ROUTES['action'] : 'intro'; ?>" />
</form>


기타(지워도 무관)
---------------------------------------------------------

### admin-lte 를 쓸 경우

```
<!-- Content : B -->
  <section class="content">

  </section>
<!-- Content : E -->
```
