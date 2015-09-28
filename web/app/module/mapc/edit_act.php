<?php
echo 'adsf';
if(!defined('__MAPC__')) { exit(); }

/**
 * 편집
 */

require(INIT_PATH . 'init.auth.php');
{ // Model : Head

    { // BLOCK:set_var:2012082201:입력값 체크 & 초기값 설정

        include_once(LIBRARY_PATH . 'mapc/string_key_gen.php');
        include_once(LIBRARY_PATH . 'mapc/file_mime_type.func.php');

        // hmmmmmmmmmnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnll <- 절대 지우지 마세요. ㅎㅎㅎㅎㅎ (사연이 있는 주석)

        // dc_identifier값이 없을 경우 새 글
        if(empty($_POST['post_uid']) || $_POST['mapc_new_post_another_lang']) {

            $is_new_post = true;

        } else {

            // DB에서 기존 정보 가져오기
            $query = "
                select post_lang, post_origin_type, post_origin_url
                  from " . $CONFIG_DB['prefix'] . "mapc_post
                 where post_uid = :post_uid
                   and post_lang = :post_lang
                  ";
            $sth = $CONFIG_DB['handler']->prepare($query);

            $sth->bindParam(':post_uid', $_POST['post_uid'], PDO::PARAM_STR);
            $sth->bindParam(':post_lang', $_POST['post_lang'], PDO::PARAM_STR);
            $sth->execute();
            $rlt = $sth->fetch(PDO::FETCH_ASSOC);

            $before_lang        = $rlt['post_lang'];
            $before_origin_type = $rlt['post_origin_type'];
            $before_origin_url  = $rlt['post_origin_url'];

            // 더블린코어에서 기존 메타정보 가져오기
            include_once($PATH['mapc']['root'] . 'model/dc_get.func.php');
            $dc_info = module_mapc_dc_get($PATH['mapc']['data'] . $before_origin_url . '.rdf');

        }

        $arg = array();

        $arg['meta']     = (!empty($_POST['meta']))  ? $_POST['meta'] : array();

        // DB핸들러
        $arg['dbh'] = $option['dbh'] = $CONFIG_DB['handler'];
        // 자료의 언어
        $option['lang'] = (string)$arg['meta']['dc_language'][0] ? (string)$arg['meta']['dc_language'][0] : $CONFIG['lang'];
        $option['lang_before'] = $before_lang ? $before_lang : $option['lang'];  // 기존 글을 변경 할 경우 기존에 썼던 언어코드 (kr->kor)로 변경 한다거나~

        // uid 시스템 내부에서 사용
        $arg['uid']      = (! empty($_POST['post_uid'])) ? $_POST['post_uid'] : mapc_string_key_gen(20);

        $arg['title']    = (! empty($_POST['post_title']))   ? $_POST['post_title']    : '';
        $arg['content']  = (! empty($_POST['post_content'])) ? $_POST['post_content']  : '';

        // slug : 서버에 넣을 파일 이름, 한글일 경우 컴터안에서 문제가 생길수 있고 UID값은 사람이 알아보기 힘들고... 그에 따른 절충안
        $arg['mapc_slug'] = (!empty($_POST['mapc_slug'])) ? $_POST['mapc_slug'] : $arg['title'];
        // cate 논리적 분류
        $arg['mapc_cate'] = (!empty($_POST['mapc_cate'])) ? $_POST['mapc_cate'] : $arg['mapc_cate'];
        // dir 물리적 분류(하드디스크 안에서)
        $arg['mapc_dir']  = (!empty($_POST['mapc_dir']))  ? $_POST['mapc_dir']  : $arg['mapc_dir'];
        // 자체화일이 아닌 외부URL일 경우에 넘어오는 값
        $arg['mapc_url']  = (!empty($_POST['mapc_url']))  ? $_POST['mapc_url']  : $arg['mapc_url'];

        // 화일명을 어떤 형태로 저장할지... (uid = UID.kor.md 형태, date = YYYYMMDD-HHIISS 형태 따위...)
        $arg['mapc_make_file'] = $_POST['mapc_make_file'];

        // mapc_dir 마지막 부분이 /가 아닐 경우 '/'추가
        // (디렉토리명은 반드시 path_a/ path_b/ 처럼 '/'로 마무리해야 됨)
        if(substr($arg['mapc_dir'], -1) != '/' && ! empty($arg['mapc_dir'])) {
            $arg['mapc_dir'] .= '/';
        }
        $arg['mapc_data_type'] = $_POST['mapc_data_type'];

    } // BLOCK


    { // BLOCK:personal_info_get:2013-01-18:로그인한 사용자의 개별 디렉터리 반환

        // get $arg['user_dir'], $arg['data_dir']
        include($PATH['mapc']['root'] . 'model/path_get_per_user.proc.php');

    } // BLOCK


    { // BLOCK:original_file:2012080901:원본파일 업로드

        // 전체 경로 (ie. mapc_data/user1234/original/memo/)
        $save_dir       = $arg['data_dir'] . 'original/' . $arg['mapc_dir'];
        // 요약본 저장 경로 (ie. mapc_data/user1234/thum/memo/)
        $save_dir_thum  = $arg['data_dir'] . 'thum/'     . $arg['mapc_dir'];
        // Mapc_data_dir 이후의 경로 (ie. user1234/original/memo/)
        $save_dir2 = $arg['user_dir'] . 'original/' . $arg['mapc_dir'];

        switch($arg['mapc_data_type']) {

            case 'markdown':
                $file_ext  = '.md';
                $file_name = $arg['mapc_slug'] . $file_ext;
                $file_name_uid = $arg['mapc_slug'] . '-' . $arg['uid'] . (string)$arg['meta']['dc_language'][0] . $file_ext; // UID가 포함된 화일명
                $arg['meta']['rdf_about'] = $file_name;
                $arg['origin_type'] = 'text/markdown';
                if(! in_array($arg['origin_type'], $arg['meta']['dc_format'])) {
                    $arg['meta']['dc_format'][] = $arg['origin_type'];
                }
                break;

            case 'text':
                $file_ext  = '.txt';
                $file_name = $arg['mapc_slug'] . $file_ext;
                $file_name_uid = $arg['mapc_slug'] . '-' . $arg['uid'] . $file_ext; // UID가 포함된 화일명
                $arg['meta']['rdf_about'] = $file_name;
                $arg['origin_type'] = 'text/plain';
                if(! in_array($arg['origin_type'], $arg['meta']['dc_format'])) {
                    $arg['meta']['dc_format'][] = $arg['origin_type'];
                }
                break;

            case 'url':
                $file_ext  = '.URL';
                $file_name = $arg['mapc_slug'] . $file_ext;
                $file_name_uid = $arg['mapc_slug'] . '-' . $arg['uid'] . (string)$arg['meta']['dc_language'][0] . $file_ext; // UID가 포함된 화일명
                $arg['meta']['rdf_about'] = $arg['mapc_url'];
                $arg['origin_type'] = 'text/url';
                if(! in_array($arg['origin_type'], $arg['meta']['dc_format'])) {
                    $arg['meta']['dc_format'][] = $arg['origin_type'];
                }
                // url타입의 경우 "내용" 대신 .URL화일 형식에 맞는 내용 등록하기
                $arg['content'] = "[InternetShortcut]\nURL=" . $arg['mapc_url'] . "\nIDList=";
                $arg['mapc_make_file'] = false; // URL값이 넘어올 경우에는 UID.KOR.txt 같은 형태로 저장이 안되게끔 막기
                break;

            case 'file_uploaded': // 이미 올라간 화일의 경우 선택한 화일에서 필요한 정보들만 가져오기
                $tmp1      = pathinfo($arg['meta']['rdf_about']);
                $tmp2      = mapc_file_mime_type($tmp1['extension']);
                $file_ext  = $tmp1['extension'];
                $file_name = $tmp1['basename'];
                $file_name_uid = $tmp1['filename'] . '-' . $arg['uid'] . '.' . $option['lang'] . '.' . $tmp1['extension']; // UID가 포함된 화일명
                $arg['origin_type'] = $tmp2['mime_type'];

                if(! in_array($arg['origin_type'], $arg['meta']['dc_format'])) {
                    $arg['meta']['dc_format'][] = $arg['origin_type'];
                }
                unset($tmp1);
                unset($tmp2);
                break;

        }


        if($arg['mapc_make_file'] == 'uid') {

            $file_name = $arg['uid'] . '.' . $option['lang'] . $file_ext;
            $arg['meta']['rdf_about'] = $file_name;

        } elseif ($arg['mapc_make_file'] == 'date') {

            $file_name = date('Ymd-His');
            $arg['meta']['rdf_about'] = $file_name;

        }

        // 일반텍스트 파일일 경우...
        if($arg['mapc_data_type'] == 'markdown' || $arg['mapc_data_type'] == 'text' || $arg['mapc_data_type'] == 'url') {

            $tmp_dir_name = (PHP_OS == 'WINNT') ? str_replace("/", "\\", $save_dir) : $save_dir;
            @mkdir($tmp_dir_name, 0777);

            // 새 글을 쓰는 데 이미 똑같은 화일이 있을 때 ABAKDQ25
            if($is_new_post && is_file($tmp_dir_name . $file_name)) {
                $file_name = $file_name_uid;

                // 타입이 URL이 아닐 경우에는 rdf_about도 변경 (URL을 입력할 경우에는 URL과 화일명이 다르기 때문에 바꾸면 안됨)
                if($arg['mapc_data_type'] != 'url') {
                    $arg['meta']['rdf_about'] = $file_name;
                }
            }

            $fp = fopen($tmp_dir_name . $file_name, 'w');
            fwrite($fp, $arg['content']);
            fclose($fp);

        // 파일 업로드일 경우
        } elseif($arg['mapc_data_type'] == 'file') {

            foreach($_FILES['post_file']['name'] as $key => $var) {

                $upload_file = basename($_FILES['post_file']['name'][$key]);
                $file_info   = pathinfo($upload_file);
                $file_name   = $file_info['basename'];
                $file_ext    = $file_info['extension'];

                // 디렉토리가 없을 경우 생성
                if(!is_dir($save_dir)){
                    // 디렉토리 구분자로 슬래시(/)를 인식못하는 OS의 경우 백슬래시로 바꿔줌
                    $tmp_dir_name = (PHP_OS == 'WINNT') ? str_replace("/", "\\", $save_dir) : $save_dir;
                    @mkdir($tmp_dir_name, 0777);
                }
                if(!is_dir($save_dir_thum)){
                    // 디렉토리 구분자로 슬래시(/)를 인식못하는 OS의 경우 백슬래시로 바꿔줌
                    $tmp_dir_name = (PHP_OS == 'WINNT') ? str_replace("/", "\\", $save_dir_thum) : $save_dir_thum;
                    @mkdir($tmp_dir_name, 0777);
                }

                // 새 글을 쓰는 데 이미 똑같은 화일이 있을 때 ABAKDQ25
                if($is_new_post && is_file($save_dir . $file_name)) {
                    $file_name_uid = $file_info['filename'] . '-' . $arg['uid'] . '.' . $option['lang'] . '.' . $file_ext; // UID가 포함된 화일명
                    $file_name = $file_name_uid;
                }

                if (move_uploaded_file($_FILES['post_file']['tmp_name'][$key], $save_dir . $file_name)) {

                    $VIEW['message'] = "file_uploaded";

                } else {

                    $VIEW['message'] = "file_upload_error";

                }

                $return = mapc_file_mime_type(strtolower($file_ext));

                $arg['origin_type']         = $return['mime_type'];
                $arg['meta']['dc_format'][] = $return['mime_type'];
                $arg['meta']['rdf_about']   = $file_name;

                $mime_type = explode("/", $arg['origin_type']);

                // 업로드한 화일이 이미지라면
                if($mime_type[0] == 'image')
                { // BLOCK:make_thum:20131122:thumnail 만들기

                    // "글쓴 날"에 "사진 짝은 날"을, "편집한 날"에 "글을 올리는 날"을 넣음
                    // 예. 1991년 2월 2일에 찍은 사진을 1991년 5월 5일에 올릴 경우 글쓴날은 2월2일 편집한 날은 5월 5일.
                    $exif = @exif_read_data($save_dir . $file_name);
                    include_once($PATH['mapc']['root'] . 'model/thum_make.func.php');

                    // exif에 들어있는 YYYY:MM:DD 형식을 YYYY-MM-DD 형식으로 바꿈 : bisaz
                    $tmp1 = array();
					$tmp_datetime = $exif['DateTimeOriginal'] ? $exif['DateTimeOriginal'] : $exif['DateTime'];
                    $tmp1 = explode(" ", $tmp_datetime);
                    $tmp2 = explode(":", $tmp1[0]);

                    $arg['date'] = $arg['meta']['dc_date'][0]   = $tmp2[0] . '-' . $tmp2[1] . '-' . $tmp2[2] . ' ' . $tmp1[1];
                    unset($tmp1);
                    unset($tmp2);

                    $option['min'] = 480;
                    $option['max'] = 640;
                    $option['copyright'] = $arg['data_dir'] . 'custom/copyright.png';
                    module_mapc_thum_make($save_dir, $save_dir_thum, $file_name, $mime_type[1], $option);

                } // BLOCK

            }

        }


		{ // BLOCK:date_set:20140320:날짜 등록

	        // 새로등록 할 경우
	        if($is_new_post) {

	            // 처음 글을 쓰는 경우 그리고 dc_date에 아무값도 안들어왔을 경우에는 현재시간이 dc_date값으로...
	            $arg['date_utc'] = gmdate('Y-m-d H:i:s');
	            $arg['meta']['dc_created'][] = $arg['date'];
	            $arg['meta']['dc_date'][]    = $arg['date'];
	            $option['is_new_post'] = true;
                if($arg['date'] == '0000-00-00 00:00:00' || empty($arg['date'])) {
                    $arg['date'] = date('Y-m-d H:i:s');
                }
	
	        // 편집일 경우
	        } else {
	
	            $arg['date'] = date('Y-m-d H:i:s');
	            $arg['meta']['dc_modified'][] = date('Y-m-d H:i:s');;
	            $option['is_new_post'] = false;
	
	        }

            $arg['date_utc'] = gmdate('Y-m-d H:i:s');

		} // BLOCK

    } // BLOCK

    { // BLOCK:db_update:20131118:DB에 정보 저장

        // 원본자료의 위치
        $arg['origin_url']  = $save_dir2 . $file_name;
        $arg['origin_type'] = $arg['origin_type'] ? $arg['origin_type'] : $arg['meta']['dc_format'][0];

        // 원래의 화일과 지금의 화일이름이 다를 경우 기존 화일 지우고 전체DB업데이트
        // #TODO (post의 status값은 원래 주인이 올린 post는 origina, 다른 사람이 퍼간건 copy라는 값을 넣어서 구분하는게 좋을듯)
        //       (원래글의 주인만 화일명 변경가능하도록!!!)
        if( $before_origin_url != $arg['origin_url'] ) {

            $query = "
                UPDATE mapc_post
                   SET post_origin_url = ?
                 WHERE post_origin_url = ?
                   AND post_lang = ?
                ";
            $sth = $CONFIG_DB['handler']->prepare($query);

            $sth->execute(array($arg['origin_url'], $before_origin_url, $option['lang']));

            // 이 화일을 사용하는 다른 글이 없으면 화일이 없으면 지우기
            if(! $is_new_post) {
                unlink($PATH['mapc']['data'].$before_origin_url);
                unlink($PATH['mapc']['data'].$before_origin_url . '.rdf');
            }

        }

        // 원문이 없을 경우 자료 요약내용을 원문에 넣음
        $arg['title']   = $arg['title'] ? $arg['title'] : _('제목없음');
        $arg['content'] = (! empty($arg['content'])) ? $arg['content'] : $arg['meta']['dc_description'][0];

        // 자료 요약이 없으면 원문의 앞부분을 "요약(description)"에 넣기
        $arg['meta']['dc_description'][0] = (! empty($arg['meta']['dc_description'][0])) ? $arg['meta']['dc_description'][0] : mb_strimwidth($arg['content'], '0', '255', '...', 'utf-8');
        $arg['meta']['mapc_cate']       = $arg['mapc_cate'];
        $arg['meta']['mapc_dir']        = $arg['mapc_dir'];
        $arg['meta']['mapc_data_type']  = $arg['mapc_data_type'];
        $arg['meta']['dc_title'][]      = $arg['title'];

        // dc_type이 빈 칸일 경우 format형태에서 앞부분만 따옴 (text/plain)일 경우 Type은 Text
        if(empty($arg['meta']['dc_type'][0])) {
            $tmp = explode("/", $arg['origin_type']);
            $arg['meta']['dc_type'][0] = $tmp[0];
            unset($tmp);
        }

        // 새 글은 identifier에 'mapc '추가
        $arg['meta']['dc_identifier'][] = ($is_new_post) ? 'mapc ' . $arg['uid'] : $arg['uid'];

        include_once($PATH['mapc']['root'] . 'model/post_update.func.php');
        include_once($PATH['mapc']['root'] . 'model/postmeta_insert.func.php');

        module_mapc_post_update($arg['uid'], $arg, $option);
        module_mapc_postmeta_insert($arg['uid'], $arg['meta'], $option);

    } // BLOCK

    { // BLOCK:dc_file_make:2012080901:메타데이타(더블린코어) 파일 생성

        include_once($PATH['mapc']['root'] . 'model/dc_make.func.php');
        module_mapc_dc_make($file_name . '.rdf', $arg['meta'], $save_dir);

    } // BLOCK

} // Model : Tail

// ======================================================================

{ // View : Head

    $VIEW['url']     = $_POST['link_to'];
    $VIEW['message'] = _('등록되었습니다.');
    $display_type = 'html_alert';

} // View : Tail

// end of file
