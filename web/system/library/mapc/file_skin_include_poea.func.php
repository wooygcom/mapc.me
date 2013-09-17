<?php
/**
 * 스킨파일 include 하기 위한 함수
 * 
 * $file_arr['key1'] (파일명)에
 * $arg_arr['key1']['data1']
 * $arg_arr['key1']['data2'] 와 같은 방식으로 변수를 전달할 수 있음
 */
    function mapc_file_skin_include_poea($file_arr, $arg_arr = array()) {

        foreach($file_arr as $key => $file) {

            $arg = array();
            $arg = $arg_arr[$key];

            include($file);

            unset($arg);

        }
        
    }

// this is it
