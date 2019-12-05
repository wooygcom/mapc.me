<?php
{ // BLOCK:proc:20191204:선처리

    // 회원처리가 필요한 경우에만 사용 필요없으면 지워도 됨
    include_once(__DIR__ . '/proc/proc.user.php');
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
    // 보안을 위해 CONFIG에서 site와 url을 제외한 모든 환경설정값 지우기
    $v = [];
    $v['url']  = isset($CONFIG['url']) ? $CONFIG['url'] : '';
    $v['menu'] = $CONFIG['menu'];
    $v['site'] = $CONFIG['site'];
    unset($CONFIG);
    @include($rootDir . '/views/' . $ROUTES['module'] . 'View.php');

} // BLOCK

// end of file
