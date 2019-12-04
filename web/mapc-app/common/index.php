<?php
{ // BLOCK:proc:20191204:선처리

    // 각 사이트별 선처리실행
    @include_once(CONFIG_PATH . 'proc.php');
    $rootDir = $rootDir ? $rootDir : __DIR__;

} // BLOCK

{ // BLOCK:get_controller:20150825:컨트롤러 불러오기

    /**
     *
     * Get Controller...
     *
     */
    @include($rootDir . '/controllers/' . $ROUTES['module'] . 'Controller.php');

} // BLOCK

{ // BLOCK:publish:20150825:출력처리

    /**
     *
     * Get VIEW file and publish
     *
     */
    // 보안을 위해 CONFIG에서 필요한 값을 제외한 모든 환경설정값 지우기
    $v = [];
    $v['url']  = $CONFIG['url'];
    $v['menu'] = $CONFIG['menu'];
    $v['site'] = $CONFIG['site'];
    unset($CONFIG);
    @include($rootDir . '/views/' . $ROUTES['module'] . 'View.php');

} // BLOCK

// end of file
