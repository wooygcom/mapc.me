<?php
/**
 * 썸네일 만들기
 *
 * @param string $path_original 원본화일이 있는 디렉토리
 * @param string $path_thum 썸네일 저장할 디렉토리
 * @param string $image_name 원본화일 이름
 * @param string $mime_type 그림포맷(확장자가 아니라 그림포맷임!!!) (jpeg, png, gif 따위)
 * @param int $option['max']  썸네일 이미지 긴축의 최대길이 (가로사진은 넓이 세로사진은 높이)
 * @param int $option['min'] 썸네일 이미지 짧은축의 최대길이 (가로사진은 높이 세로사진은 넓이)
 * @param string $option['copyright'] 카피라이트 그림
 *
 * @return bool $return 성공여부 (함수가 실행됨과 동시에 썸네일을 만들고 저장하는 방식이라 특별한 리턴값이 필요없음)
 */

{ // BLOCK:example:20150922
/*
    $option['min'] = 480;
    $option['max'] = 640;
    $option['copyright'] = $arg['data_dir'] . 'custom/copyright.png';
    module_mapc_thum_make($save_dir, $save_dir_thum, $file_name, $mime_type[1], $option);
*/
} // BLOCK

function module_mapc_thum_make($path_original, $path_thum, $file_name, $mime_type, $option = array('max' => 1024, 'min' => 768)) {

    // 이미지 비율 조정값 구하는 함수
    include_once(LIBRARY_PATH . 'mapc/img_resize_value.func.php');

    if(! is_dir($path_thum)) {
        mkdir($path_thum);
    }

    // 그림 크기 줄이기
    $imagecreatefrom_func = 'imagecreatefrom' . $mime_type;
    $image_func           = 'image' . $mime_type;
    $pic    = getimagesize($path_original . $file_name);
    $origin = $imagecreatefrom_func($path_original . $file_name);
    if($pic[0] < $pic[1]) { // 높이가 넓이보다 더 클 경우(세로사진일 경우)
        $thum_width = $option['min'];
        $thum_height= $option['max'];
    } else {
        $thum_width = $option['max'];
        $thum_height= $option['min'];
    }
    $temp_size = mapc_img_resize_value($pic[0], $pic[1], $thum_width, $thum_height);
    $thum_width = $temp_size[0];
    $thum_height= $temp_size[1];

    $thum   = imagecreatetruecolor($thum_width, $thum_height);
    imagecopyresampled($thum, $origin, 0, 0, 0, 0, $thum_width, $thum_height, $pic[0], $pic[1]);

    // 카피라이트 붙이기
    if(is_file($option['copyright'])) {
        $img_copyright = imagecreatefrompng($option['copyright']);
        $img_copy_width  = imagesx($img_copyright);
        $img_copy_height = imagesy($img_copyright);
        $destX = ($thum_width  - $img_copy_width) - 10;
        $destY = ($thum_height - $img_copy_height) / 1;

        imagecopymerge($thum, $img_copyright, $destX, $destY, 0, 0, $img_copy_width, $img_copy_height, 30);
    }

    $image_func($thum, $path_thum . $file_name);

}

// this is it
