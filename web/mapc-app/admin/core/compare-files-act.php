<?php
/**
 * Compare files
 *
 * /original/config/config.php vs /target/config/config.php
 */
if(! defined("__MAPC__")) { exit; }

{ // BLOCK::20151002

    // #TODO 원본화일에 있는 변수가 복사본화일에도 있나없나 체크
    // (복사해서 사용하는 화일들이 최신버전인지 확인하기 위함)
    require(INIT_PATH . 'init.admin.php');

    $origin = $_POST['origin'];
    $target = $_POST['target'];

    // $origin 화일내용가져오기...
    $contents = file_get_contents(ROOT_PATH . $origin);
    $content  = explode("\n", $contents);

    header('Content-Type: text/html; charset=UTF-8');
    echo '<pre>';
    foreach($content as $key => $var) {

        // #TODO 중첩된 BLOCK문도 출력가능하도록 변경해야 됨
        if(strpos($var, '{ // BLOCK') !== false) {
            $block = true;
        }

        if($block == true) {
            echo $var;
            echo "\n";
        }

        if(strpos($var, '} // BLOCK') !== false) {
            $block = false;
        }

    } // foreach($content as $key => $var)
    echo '</pre>';

    // $origin 화일에서 BLOCK내용 추출하기...

} // BLOCK

// end of file
