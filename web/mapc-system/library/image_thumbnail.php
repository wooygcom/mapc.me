<?php
if(! function_exists(imageThumbnail)) {
    function imageThumbnail($file, $save_filename)
    {
        $width_limit  = 1024; // 원하는 가로길기 limit값 
        $height_limit = 1024; // 원하는 세로길기 limit값
  
        $fileinfo = pathinfo($file);
        $ext = strtolower($fileinfo['extension']);

        if($ext == 'jpg' || $ext == 'jpeg') {

            // 그림 회전 : B
            if(function_exists('exif_read_data')
                && function_exists('imagecreatefromjpeg')
                && function_exists('imagerotate')
            ) {

                $exif = exif_read_data($file); // get exif data. jpeg 나 tiff 의 경우에만 갖고 있음
                $source = imagecreatefromjpeg($file); // 임시 리소스 생성

                //값에 따라 회전
                switch($exif['Orientation']){
                    case 8 : $source = imagerotate($source,90,0); break;
                    case 3 : $source = imagerotate($source,180,0); break;
                    case 6 : $source = imagerotate($source,-90,0); break;
                }

                //결과 처리
                imagejpeg($source, $src_img);
                imagedestroy($source);

            } else {

                $src_img = ImageCreateFromJPEG($file); //JPG파일로부터 이미지를 읽어옵니다

            }
            // 그림 회전 : E

        } elseif($ext == 'png') {
            $src_img = ImageCreateFromPng($file);
        } elseif($ext == 'gif') {
            $src_img = ImageCreateFromGif($file);
        } else {
            echo 'extension Error';
            exit;
        }

        $imgsize = getimagesize($file); 
        $img_width = $imgsize[0]; 
        $img_height = $imgsize[1]; 
        if($img_width>$width_limit || $img_height>$height_limit) { 
        // 가로길이가 가로limit값보다 크거나 세로길이가 세로limit보다 클경우 
            if($img_width<$imgsize[1]) { 
            // 가로가 세로보다 클경우 
                    $sumw = (100*$height_limit)/$img_height; 
                    $img_width_thumb  = ceil(($img_width*$sumw)/100); 
                    $img_height_thumb = $height_limit; 
            } else { 
            // 세로가 가로보다 클경우 
                    $sumh = (100*$width_limit)/$img_width; 
                    $img_height_thumb = ceil(($img_height*$sumh)/100); 
                    $img_width_thumb  = $width_limit; 
            } 
        } else { 
        // limit보다 크지 않는 경우는 원본 사이즈 그대로..... 
            $img_width_thumb  = $imgsize[0]; 
            $img_height_thumb = $imgsize[1]; 
        } 

        $dst_img = imagecreatetruecolor($img_width_thumb, $img_height_thumb); //타겟이미지를 생성합니다

        ImageCopyResized($dst_img, $src_img, 0, 0, 0, 0, $img_width_thumb, $img_height_thumb, $img_width, $img_height); //타겟이미지에 원하는 사이즈의 이미지를 저장합니다

        ImageInterlace($dst_img);
        ImageJPEG($dst_img, $save_filename); //실제로 이미지파일을 생성합니다
        ImageDestroy($dst_img);
        ImageDestroy($src_img); //메모리상의 이미지를 삭제합니다.
    }

}

// this is it
