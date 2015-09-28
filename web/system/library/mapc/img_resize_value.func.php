<?php
/**
 *
 * 이미지 비율 조절값 구하기
 *
 * 원본의 크기를 줄이고자 하는 값에 맞춰 비율을 맞춰줌
 *
 * @param int $width  원본 그림의 넓이
 * @param int $height 원본 그림의 높이
 * @param int $max_width  원본 그림의 넓이
 * @param int $max_height 원본 그림의 높이
 *
 * @return int $img_size[0] 비율조정할 때의 넓이
 * @return int $img_size[1] 비율조정할 때의 높이
 *
 */
function mapc_img_resize_value($width, $height, $max_width, $max_height) {

    if($width>$max_width || $height>$max_height) {
        // 가로길이가 가로limit값보다 크거나 세로길이가 세로limit보다 클경우
        $sumw = (100*$max_height)/$height;
        $sumh = (100*$max_width)/$width;
        if($sumw < $sumh) {
            // 가로가 세로보다 클경우
            $img_width = ceil(($width*$sumw)/100);
            $img_height = $max_height;
        } else {
            // 세로가 가로보다 클경우
            $img_height = ceil(($height*$sumh)/100);
            $img_width = $max_width;
        }
    } else {
        // limit보다 크지 않는 경우는 원본 사이즈 그대로.....
        $img_width = $width;
        $img_height = $height;
    }

    $img_size[0] = $img_width;
    $img_size[1] = $img_height;

    return $img_size;

}

// this is it
