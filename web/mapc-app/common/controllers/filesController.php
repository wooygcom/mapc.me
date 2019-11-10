<?php
if(!defined("__MAPC__")) { exit(); }

// #TODO camp별 branch별로 따로 업로드 되도록...
$uploads_dir = DATA_PATH . $CONFIG['upload_dir'];

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    include(LIBRARY_PATH . 'image_thumbnail.php');

    $dir_Y = date('Y');
    $dir_m = date('m');
    $dir_d = date('d');

    $args   = '';
    $argSep = '?';
    $group  = $_POST['group'];
    $group2 = $_POST['group2'];

    if($group) {
        $uploads_dir .= DS . $_POST['group'];
        $args  .= $argSep . 'group=' . $group;
        $argSep = '&';
    }
    if($group2) {
        $uploads_dir .= DS . $_POST['group2'];
        $args  .= $argSep . 'group2=' . $group2;
        $argSep = '&';
    }

    $uploads_dir_real = $uploads_dir . DS . $dir_Y . DS . $dir_m . DS . $dir_d . DS;
	$allowed_ext = array('jpg','jpeg','png','gif');

	// 변수 정리
	$error = $_FILES['file']['error'];
	$name  = $_FILES['file']['name'];
	$ext   = array_pop(explode('.', $name));
	$uniqid = uniqid(); // 파일명에 들어갈 고유값

	// 오류 확인
	if( $error != UPLOAD_ERR_OK ) {
		switch( $error ) {
			case UPLOAD_ERR_INI_SIZE:
			case UPLOAD_ERR_FORM_SIZE:
				echo "파일이 너무 큽니다. ($error)";
				break;
			case UPLOAD_ERR_NO_FILE:
				echo "파일이 첨부되지 않았습니다. ($error)";
				break;
			default:
				echo "파일이 제대로 업로드되지 않았습니다. ($error)";
		}
		exit;
	}

	// 확장자 확인
	if( !in_array(strtolower($ext), $allowed_ext) ) {
		echo "허용되지 않는 확장자입니다.";
		exit;
	}

    // #TODO 파일명에 들어가는 날짜를 원글의 글쓴날의 날짜로 대체~!!! date함수 대신 원글Ymd로 대체~!!!!!
    $server_filename = date('Ymd-His') . '.' . $uniqid . '.' . $ext;
    $server_filename_thumb = date('Ymd-His') . '.' . $uniqid . '.thumb.' . $ext;

	if(! is_dir($uploads_dir_real)) {
		mkdir($uploads_dir_real, 0777, true);
	}

	// 파일 이동
	move_uploaded_file( $_FILES['file']['tmp_name'], $uploads_dir_real . $server_filename );
    // #TODO jpg 이외의 파일도 썸네일 만들어지도록~
    if($ext == 'jpg') {
        imageThumbnail(
            $uploads_dir_real . $server_filename,
            $uploads_dir_real . $server_filename_thumb
        );
    }

	// 파일 정보 출력
	echo ROOT_URL . 'common/files/' . $server_filename . $args;

} else {

    $group  = $_GET['group'];
    $group2 = $_GET['group2'];
    // 파일명
	$filename = $ROUTES['id'];
    // 확장자
    $ext   = array_pop(explode('.', $filename));
    // 파일명.thumb.확장자 이름 구하기 (파일명만 넘어오기 때문에 thumb구하는 로직이 따로 필요함)
    $filename_thumb = substr($filename, 0, -1*(strlen($ext)+1)) . '.thumb.' . $ext;
	$dir_Y = substr($filename, 0, 4);
	$dir_m = substr($filename, 4, 2);
	$dir_d = substr($filename, 6, 2);

    if($group) {
        $uploads_dir .= DS . $group;
    }
    if($group2) {
        $uploads_dir .= DS . $group2;
    }
    $uploads_dir_real = $uploads_dir . DS . $dir_Y . DS . $dir_m . DS . $dir_d . DS;

	if(is_file($uploads_dir_real . $filename_thumb)) {
        $imgpath = $uploads_dir_real . $filename_thumb;
    } else {
        $imgpath = $uploads_dir_real . $filename;
    }


    // Get the mimetype for the file
    $finfo = finfo_open(FILEINFO_MIME_TYPE);  

    // return mime type ala mimetype extension
    $mime_type = finfo_file($finfo, $imgpath);
     
    finfo_close($finfo);

    switch ($mime_type){

        case "image/jpeg":

            // Set the content type header - in this case image/jpg
            header('Content-Type: image/jpeg');
              
            // Get image from file
            $img = imagecreatefromjpeg($imgpath);
              
            // Output the image
            imagejpeg($img);
              
            break;

        case "image/png":

            // Set the content type header - in this case image/png
            header('Content-Type: image/png');
              
            // Get image from file
            $img = imagecreatefrompng($imgpath);
              
            // integer representation of the color black (rgb: 0,0,0)
            $background = imagecolorallocate($img, 0, 0, 0);
              
            // removing the black from the placeholder
            imagecolortransparent($img, $background);
              
            // turning off alpha blending (to ensure alpha channel information 
            // is preserved, rather than removed (blending with the rest of the 
            // image in the form of black))
            imagealphablending($img, false);
              
            // turning on alpha channel information saving (to ensure the full range 
            // of transparency is preserved)
            imagesavealpha($img, true);
              
            // Output the image
            imagepng($img);
              
            break;

        case "image/gif":
            // Set the content type header - in this case image/gif
            header('Content-Type: image/gif');
              
            // Get image from file
            $img = imagecreatefromgif($imgpath);
              
            // integer representation of the color black (rgb: 0,0,0)
            $background = imagecolorallocate($img, 0, 0, 0);
              
            // removing the black from the placeholder
            imagecolortransparent($img, $background);
              
            // Output the image
            imagegif($img);
              
            break;
    }

    // Free up memory
    imagedestroy($img);

}

// this is it
