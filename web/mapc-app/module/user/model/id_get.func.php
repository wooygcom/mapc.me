<?php
function module_user_id_get() {

    { // BLOCK:get_my_id:20150922

        // 회원인 경우
        if(! empty($_SESSION['mapc_user_id'])) {

            $my_id = $_SESSION['mapc_user_id'];

        // 손님인 경우
        } else {

            // 쿠키 생성이 안되어있으면...
            if(empty($_COOKIE['my_id'])) {

                $my_id = substr(md5($_SERVER['REMOTE_ADDR'] . rand(1000, 9999)), 0, 25);
                setcookie("my_id", $my_id);

            } else {

                $my_id = $_COOKIE['my_id'];

            }

        }

    } // BLOCK

    return $my_id;
}

// end of file
