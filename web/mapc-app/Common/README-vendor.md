Vendors
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
