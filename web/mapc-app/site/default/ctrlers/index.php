<?php
if(!defined('__MAPC__')) { exit(); }

require(INIT_PATH . 'init.core.php');
{ // MODEL : Start

    { // BLOCK:get_popup:20150905

        // 팝업 모듈이 있을 경우에는 팝업 출력
        if(is_file(MODULE_PATH . 'popup/model/popup_get.func.php')) {

            include(MODULE_PATH . 'popup/model/popup_get.func.php');
            $VIEW['popup'] = popup_get();

        }

    } // BLOCK

} // MODEL : Finish


{ // View : Start

    $VIEW['layout_file'] = 'html_main.view.php';

} // View : Finish

// this is it
