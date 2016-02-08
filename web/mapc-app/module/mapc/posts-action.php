<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * Posts 관련 실행처리
 */

require(INIT_PATH.'init.db.php');
{ // Model : Head

    { // BLOCK:get_config:20151226

        // module/모듈명/config/config.php
        $mapcConfig = include_once(__DIR__ . '/config/config.php');

    } // BLOCK

    $title   = $_POST['post-title'];
    $content = $_POST['post-content'];
    $url     = $_POST['post-url'];

    switch ($_POST['_method']) {
        case 'post':
/*
$origin_url 원본의 URL

상황1
    마크다운이 들어 올 때
    origin은 content의 내용 그대로
상황2
    마크다운 + 마크다운 안에 [그림](그림주소) 가 들어 있을 때
    해결책 1
        마크다운 내부의 [화일이름]img/image.gif(이미지의 상대주소)를
        [화일이름](file&file-id=FILEID)형태로 변경
        물론 이렇게 하기 전에 이미지가 DB에 등록되어있어야 되겠지만...
    해결책2
        [화일이름](file&path=/path/file.jpg)로 변경
        file.php에서는 data/원본글주인/path/file.jpg 에서 화일을 가져옴
상황3
    내용안에 외부사이트가 있을 때(og태그)

`post_seq`, `post_uid`, `post_lang`
`post_title`, `post_content`, `post_content_type`, `post_origin_type`, `post_origin_server`, `post_origin_url`
`post_write_date`, `post_edit_date_latest`, `post_status`, `post_user_uid`, `post_user_name`, `post_etc`

넘어오는 값 종류
URL 외부 사이트
웹페이지
동영상
이미지
*/

            // #TODO 자동처리
                // - 제목이 안들어왔을 때... (앞 80글자를 제목으로)
            // #TODO 자동처리
                // - 내용이 안들어왔을 때... (URL이 들어온 경우 해당URL을 분석한 뒤 그 사이트에서 제목과 내용을 긁어옴)
            // #TODO 자동처리
                // - URL이 안들어왔는데 내용중에 URL이 있을 경우 (그냥 내용 중 일부로 처리, 본문TYPE = origin_type)
            // #TODO 자동처리
                // - 내용중에 그림이나 미디어 화일이 들어있을 경우
                //   내부 화일(마크다운)에는 [실제경로](./file.jpg) 형태로
                //   DB에는 [화일ID](diak291jt2i7aawy) 형태로 저장
                //   (외부화일은 당연히 전체URL)
            break;

        case 'patch':
            // code...
            break;

        case 'delete':
            // code...
            break;

        default:
            //
            exit;
            break;
    }

} // Model : Tail

// ======================================================================

// 일반적인 경우

{ // View : Head

} // View : Tail

// end of file
