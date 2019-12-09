<?php
{ // BLOCK:proc:20191204:선처리

    // 회원처리가 필요한 경우에만 사용 필요없으면 지워도 됨
    include_once(PROC_PATH . 'proc.user.php');
    $rootDir = $rootDir ? $rootDir : __DIR__;

} // BLOCK

{ // BLOCK:get_controller:20150825:컨트롤러 불러오기

    @include($rootDir . DS . '..' . DS . 'common' . DS . 'index.php');

} // BLOCK

// end of file
