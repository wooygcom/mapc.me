<?php
define('__MAPC__', true);

session_start();

{ // BLOCK:license:20150928

    // 라이센스 동의확인

    if ($_POST['agree']) {
        $_SESSION['license'] = $_POST['agree'];
    }

    if(empty($_SESSION['license'])) {
        // 라이센스 동의 페이지
        $page = 'license';
    } elseif(empty($_REQUEST['page'])) {
        $page = 'config';
    } else {
        $page = $_REQUEST['page'];        
    }

} // BLOCK

// end of file
