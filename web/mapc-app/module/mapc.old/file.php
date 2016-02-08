<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 화일 출력
 */

require(INIT_PATH . 'init.db.php');
{ // Model : Head

    $display_direct = $ARGS['display_direct'];

    { // BLOCK:personal_info_get:2013-01-18:로그인한 사용자의 개별 디렉터리 반환

        // get $arg['user_dir'], $arg['data_dir']
        include($PATH['mapc']['root'] . 'model/path_get_per_user.proc.php');

    } // BLOCK

    // UID값을 기준으로 원본 화일을 가져오고
    $uid = $ARGS['mapc_uid'];
	$query = 'SELECT post_origin_type, post_origin_url FROM ' . $CONFIG_DB['prefix'] . 'mapc_post WHERE post_uid = "' . $uid . '"';

	$sth = $CONFIG_DB['handler']->prepare($query);
	$sth->execute();

	$file_info = $sth->fetch(PDO::FETCH_ASSOC);

    // 바로 보여줄 때...
    if ($display_direct == 'yes') {

        $url  = $PATH['mapc']['data'] . $file_info['post_origin_url'];

        $fp   = fopen($url,"r");
        $data = fread($fp, filesize($url));
        fclose($fp);

        header('Content-type: ' . $file_info['post_origin_type']);
        echo $data;

        exit;
    }

    // 원본 형식에 따라 내용 출력
    switch($file_info['post_origin_type']) {
        case 'application/pdf':
            $display_type = 'download';
            break;

        case 'image/jpeg':
        case 'image/gif':
        case 'image/png':
        default:

            $display_type = 'image';

            // 저작권자 표시...
            {

                // 저작권자 표시
    			$watermark = imagecreatefrompng($arg['data_dir'] . 'custom/copyright.png');
    			$watermark_width = imagesx($watermark);     
    			$watermark_height = imagesy($watermark);

    			// 원본 파일 가져오기
    			$filename = $PATH['mapc']['data'] . $file_info['post_origin_url'];
                switch($file_info['post_origin_type']) {
                    case 'image/png':
                        $image = imagecreatefrompng($filename);
                        break;
                    case 'image/gif':
                        $image = imagecreatefromgif($filename);
                        break;
                    case 'image/jpeg':
                        $image = imagecreatefromjpeg($filename);
                        break;
                }
    			$size  = getimagesize($filename);
    			$dest_x = $size[0] - $watermark_width;
    			$dest_y = $size[1] - $watermark_height;
    			
    			$base_image = imagecreatetruecolor($size[0], $size[1]);
    			
    			imagesavealpha($watermark, true);
    			imagealphablending($watermark, true);
    			
    			imagesavealpha($base_image, true);
    			imagealphablending($base_image, true);
    			
    			// merge images
    			imagecopy($base_image, $image, 0, 0, 0, 0, $size[0], $size[1]);
    			imagecopymerge($base_image, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height, 50);

            }

            break;

    }

} // Model : Tail

{ // View : Head

    switch($display_type) {
        case 'download';
            header("Content-type: application/octet-stream"); 
            header("Content-Disposition: attachment; filename=" . $URL['core']['root'] . 'mapc/file/mapc_uid/' . $file_info['post_origin_url'] . 'download/1/'); 
            Header("Expires: 0"); 
            break;
        default:
            header('Content-type: ' . $file_info['post_origin_type']);
            break;
    }

    switch($file_info['post_origin_type']) {
        case 'image/png':
            imagepng($base_image);
            imagedestroy($base_image);
            imagedestroy($watermark);
            break;
        case 'image/gif':
            imagegif($base_image);
            imagedestroy($base_image);
            imagedestroy($watermark);
            break;
        case 'image/jpeg':
            imagejpeg($base_image);
            imagedestroy($base_image);
            imagedestroy($watermark);
            break;
        case 'application/pdf':
            break;
    }

} // View : Tail

// this is it
