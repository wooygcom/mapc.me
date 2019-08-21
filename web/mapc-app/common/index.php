<?php
{ // BLOCK:proc:20190617:프로시저불러오기

    // https://www.php.net/manual/en/function.spl-autoload-register.php#117805
    // 위 글 보니 session_start 앞에 붙이라고 하길래...
    // #OPTION include_once(SYSTEM_PATH . 'proc/proc.autoload.php');

} // BLOCK

{ // BLOCK:get_controller:20150825:컨트롤러 불러오기

    /**
     *
     * Get Controller...
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

// end of file
