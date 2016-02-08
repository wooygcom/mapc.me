<?php
function local_utf8_ord_qoak($ch) {

    $len = strlen($ch);

    if($len <= 0) return false;

    $h = ord($ch{0});

    if ($h <= 0x7F) { return $h; }
    if ($h < 0xC2) { return false; }
    if ($h <= 0xDF && $len>1) { return ($h & 0x1F) <<  6 | (ord($ch{1}) & 0x3F); }
    if ($h <= 0xEF && $len>2) { return ($h & 0x0F) << 12 | (ord($ch{1}) & 0x3F) << 6 | (ord($ch{2}) & 0x3F); }
    if ($h <= 0xF4 && $len>3) { return ($h & 0x0F) << 18 | (ord($ch{1}) & 0x3F) << 12 | (ord($ch{2}) & 0x3F) << 6 | (ord($ch{3}) & 0x3F); }

    return false;

}

function mapc_string_hangeul_cho_get() {

    $cho = array("ㄱ","ㄲ","ㄴ","ㄷ","ㄸ","ㄹ","ㅁ","ㅂ","ㅃ","ㅅ","ㅆ","ㅇ","ㅈ","ㅉ","ㅊ","ㅋ","ㅌ","ㅍ","ㅎ");
    return $cho;
}

// 출처 :  http://zetawiki.com/wiki/UTF-8_%ED%95%9C%EA%B8%80_%EC%B4%88%EC%84%B1_%EC%B6%94%EC%B6%9C_%28PHP%29#.EC.86.8C.EC.8A.A4.EC.BD.94.EB.93.9C 
function mapc_string_hangeul_cho($str, $len = 0, $options = array()) {

    $cho = mapc_string_hangeul_cho_get();

    $result = "";

    $str_len = ($len == 0) ? mb_strlen($str, 'UTF-8') : $len;

    for ($i=0; $i < $str_len; $i++) {

        $code = local_utf8_ord_qoak(mb_substr($str, $i, 1, 'UTF-8')) - 44032;

        // 자음으로만 되어있을 경우...
        $code_2 = ($code+31439);
        if ($code_2 > 0 && $code_2 <= 29) {

            // ㄱ=0,ㄲ=1,ㄴ=3,ㄷ=6,ㄸ=7,ㄹ=8,ㅁ=16,ㅂ=17,ㅃ=18,ㅅ=20,ㅆ=21,ㅇ=22,ㅈ=23,ㅉ=24,ㅊ=25,ㅋ=26,ㅌ=27,ㅍ=28,ㅎ=29
            $jaeum = array(0, 1, 3, 6, 7, 8, 16, 17, 18, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29);
            $cho_idx = array_search($code_2, $jaeum);
            $return['is_hangeul'] = true;

        }

        // 한글낱말일 경우... 가나다, 순우리말, 한글....
        if ($code > -1 && $code < 11172) {

            $cho_idx = $code / 588;
            $return['is_hangeul'] = true;

        }

        if($return['is_hangeul']) {

            if($options['return_key']) {
                $return['str'] .= floor($cho_idx);
            } else {
                $return['str'] .= $cho[$cho_idx];
            }

        }

    }

    return $return;

}

// this is it
