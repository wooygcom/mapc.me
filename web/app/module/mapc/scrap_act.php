<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 글보기
 */

// #TODO 같은 코드 다른 언어를 스크랩할 때 제대로 못불러오는 듯함... N59MB4HTLDZJ13EXRVUK (레고)를 스크랩할 때 eng만 등록되고 kor은 등록 안됨

require(INIT_PATH . 'init.auth.php');
{ // Model : Head

    { // BLOCK:arg_check:20140405:넘김값 정리

        $scrap_type        = $_POST['scrap_type'];
        $scrap_option_db   = $_POST['scrap_option_db'];
        $scrap_option_rdf  = $_POST['scrap_option_rdf'];
        $scrap_option_thum = $_POST['scrap_option_thum'];

    } // BLOCK

    { // BLOCK:include_file20140406:화일 불러오기

        include_once($PATH['mapc']['root'] . 'model/dc_make.func.php');
        include_once($PATH['mapc']['root'] . 'model/thum_make.func.php');
        include_once(LIBRARY_PATH . 'mapc/string_key_gen.func.php');

	} // BLOCK

    switch($scrap_type) {
        // DB에 있는 화일들 검사하고 실제 화일이 없을 경우 DB에서 지우기
        case 'del':
            $query = " select post_uid, post_origin_url from " . $CONFIG_DB['prefix'] . "mapc_post ";
            $sth = $CONFIG_DB['handler']->prepare($query);
            $sth->execute();
            $rst = $sth->fetchAll(PDO::FETCH_NUM);

            foreach($rst as $key => $var) {

                if(! is_file($PATH['mapc']['data'] . $var[1])) {
                    $query   = "delete from " . $CONFIG_DB['prefix'] . "mapc_post where post_uid = ? and post_origin_url = ?";
                    $sth_del = $CONFIG_DB['handler']->prepare($query);
                    $sth_del->execute( array($var[0], $var[1]) );
                }

            }

            unset($query);
            unset($sth);
            unset($sth_del);
            unset($rst);

            break;

        // 실제 화일을 불러와서 DB에 넣기
        case 'scrap':
        default:
            unset($save_dir);
            // $arg['user_dir'], $arg['data_dir'] return
            include($PATH['mapc']['root'] . 'model/path_get_per_user.proc.php');
            $save_dir = $PATH['mapc']['data'] . $arg['user_dir'];

            { // BLOCK:get_scrap_config:20140113:스크랩할 때 필요한 설정 가져오기

                include_once($arg['data_dir'] . 'custom/mapc_config.php');

            } // BLOCK
            
            include_once(LIBRARY_PATH . 'mapc/dir_list.func.php');
            $option['show_sub'] = true;
            $option['show_base']= true;
            $option['ext_exp'] = 'rdf';

            $dir_list = mapc_dir_list($save_dir.'/original/', $option);

            include_once($PATH['mapc']['root'] . 'model/post_update.func.php');
            include_once($PATH['mapc']['root'] . 'model/postmeta_insert.func.php');
            include_once($PATH['mapc']['root'] . 'model/dc_get.func.php');

            $count_rdf_to_db = 0;
            $count_rdf_make = 0;

            // 메타정보 입력
            if(is_array($dir_list)) {

				$delay_time = 0;

                foreach($dir_list as $each_file) {
/*
					$delay_time++;

					if($delay_time > 10) {
						sleep(1);
						$delay_time = 0;
					}
*/
                    unset($post_info);
                    unset($dc_info);

					include_once(LIBRARY_PATH . 'mapc/pathinfo_utf.func.php');
                    $file_info = mapc_pathinfo_utf($each_file);

                    // 화일에 딸린 rdf화일이 있을 경우
                    if(is_file($each_file . '.rdf')) {

                        // 더블린 코어 정보들 가져오기
                        $dc_info = module_mapc_dc_get($each_file . '.rdf');

                        // subject / subject_id 처럼 어떤 항목에 종속되는 다른 항목이 있을 경우
                        // attribute가 있는지 체크하고 있으면 $key_id 값에 지정
                        foreach($dc_info as $tmp_dc_key => $tmp_dc_var) {

                            foreach($tmp_dc_var as $tmp_dc_key2 => $tmp_dc_var2) {

                                $etc++;
                                if(! empty($tmp_dc_var2->attributes()->xsi_type) ) {
                                    $dc_info->{$tmp_dc_key2.'_id'}[$etc] = (string)$tmp_dc_var2->attributes()->xsi_type;
                                }

                            }

                        }

                        $dc_info->rdf_about = $file_info['basename'];
                        $dc_info->mapc_dir  = str_replace(array($save_dir.'original/', $file_info['basename']), '', $each_file);

                        $post_info['uid']   = $dc_info->dc_identifier[0];

                        // uid 앞부분에 mapc가 적혀있는 것들만 mapc 지우게 하기!!! 'mapc ABCDEFGHIJ' 이런형태의 것들만...
                        if(strpos($post_info['uid'], 'mapc ') !== false) {
                            $post_info['uid']   = str_replace('mapc ', '', $post_info['uid']); // DB에 등록하기 전에 UID 처음부분의 "mapc "구분자는 지우기
                        }
                        $post_info['title'] = (string)$dc_info->dc_title[0];
                        $post_info['date']  = (string)$dc_info->dc_date[0];
                        $post_info['lang']  = (string)$dc_info->dc_language[0];

                        $post_info['origin_url'] = $arg['user_dir'] . 'original/' . $dc_info->mapc_dir . $dc_info->rdf_about;

                        // 화일 형식이 뭔지 체크
                        // 단, dc_format에 화일 형식 이외의 다른 값들도 있으므로...
                        // 화일 형식 부분(mime type)만 추출해서 등록
                        foreach($dc_info->dc_format as $temp_format) {

                            $temp_format = strtolower($temp_format);
                            if(
                                $temp_format == 'text/plain'
                             || $temp_format == 'text/markdown'
                             ||	$temp_format == 'image/jpeg'
                             || $temp_format == 'image/png'
                             || $temp_format == 'image/gif'
                            ) {
                                $post_info['origin_type'] = $temp_format;
                            }

                        }

                        unset($temp_format);

                        $post_info['content'] = '';

                        $mime_type = explode("/", $post_info['origin_type']);

                        switch($mime_type[0]) {
                            // 화일포맷이 텍스트일 경우(DB에 원문 그대로 입력)
                            case 'text':
                                $temp_contents = file($each_file);
                                foreach($temp_contents as $temp_line) {
                                    $post_info['content'] .= $temp_line;
                                }

                                unset($temp_contents);
                                unset($temp_line);
                                break;

                            case 'image':
                                { // BLOCK:make_thum:20131122:thumnail 만들기

                                    $option['min'] = 768;
                                    $option['max'] = 1024;
                                    $option['copyright'] = $arg['data_dir'] . 'custom/copyright.png';
                                    // 썸네일 디렉토리가 없을 경우 생성
                                    $thum_dir = $save_dir . 'thum/' . $dc_info->mapc_dir;
                                    if(! is_dir($thum_dir)) {
                                        $tmp_dir_name = (PHP_OS == 'WINNT') ? str_replace("/", "\\", $thum_dir) : $thum_dir;
                                        mkdir($tmp_dir_name, 0755, true);
                                        unset($tmp_dir_name);
                                    }

                                    // 썸네일 화일이 없으면 생성하기
                                    if($scrap_option_thum == 'thum' && ! is_file($save_dir . 'thum/' . $dc_info->mapc_dir . $file_info['basename'])) {
                                        module_mapc_thum_make(
                                            $save_dir . 'original/' . $dc_info->mapc_dir,
                                            $save_dir . 'thum/' . $dc_info->mapc_dir,
                                            $file_info['basename'],
                                            $mime_type[1],
                                            $option
                                        );
                                    }

                                } // BLOCK

                            // 텍스트 이외의 것들은 설명(더블린 코어 description의 내용)을 DB에 넣기...
                            default:
                                $post_info['content'] = (string)$dc_info->dc_description[0];
                                break;

                        }

                        $option['dbh'] = $CONFIG_DB['handler'];

                        $query = "
                            select post_write_date, post_edit_date_latest
                              from " . $CONFIG_DB['prefix'] . "mapc_post
                             where post_uid  = ?
                               and post_lang = ?
                            ";

                        $sth = $option['dbh']->prepare($query);

                        $sth->execute( array($post_info['uid'], $post_info['lang']) );

                        $rst = $sth->fetch(PDO::FETCH_ASSOC);
                        // 이미 등록되어있는 자료인데...
                        if(! empty($rst['post_write_date'])) {
                            // 전에 등록한 날짜와 지금 등록하려는 날짜가 다르고 최종 편집일과도 다를 때에는 update
                            if(($rst['post_write_date'] != $dc_info->dc_date[0]) && (! empty($dc_info->dc_modified[0]) && ($rst['post_edit_date_latest'] != $dc_info->dc_modified[0]) )) {
                                $post_info['date'] = $dc_info->dc_modified[0];
                                $option['is_new_post'] = false;

                            // 자료가 이미 있을 경우 건너띄기
                            } else {
                                continue;
                            }
                        } else {
                            $option['is_new_post'] = true;
                        }

                        $option['lang'] = (string)$dc_info->dc_language[0] ? (string)$dc_info->dc_language[0] : $CONFIG['lang'];

						if($scrap_option_db == 'db') {

	                        module_mapc_post_update($post_info['uid'], $post_info, $option);
	                        module_mapc_postmeta_insert($post_info['uid'], $dc_info, $option);

	                        $count_rdf_to_db++;

						}

                    // rdf화일이 없을 경우 rdf화일을 새로 만듦
                    } elseif(is_file($each_file)) {

						$tmp_array = array();
						// 각 화일에서 /data/mapc/사용자아이디/original 부분을 뺀 나머지 부분에서 각각의 디렉토리이름을 저장 (나중에 "주제"에 넣을 것)
						$tmp_subjects = explode("/", dirname( str_replace($save_dir."original/", "", $each_file) ) );

                        // 디렉토리 위치와 환경설정에서의 위치가 동일 할 경우 미리 지정된 환경설정값을 불러온다. (예:풍경/ 디렉토리에 있는 사진의 주제를 (환경설정에서 '풍경사진'으로 지정되어있을 경우) '풍경사진'으로 지정
                        if(is_array($CONFIG_MODL_MAPC['scrap'])) {

                            foreach($CONFIG_MODL_MAPC['scrap'] as $config_key => $config_var) {

                                if(strpos($each_file, $config_var['dir']) !== false) {

									/**
									 *  풍경/한국/산/ 이런 디렉토리 안에 있는 자료의 경우 각각의 디렉토리 이름이 주제가 되는데
									 * 환경설정에 이미 어떤 값으로 넣을지 정해져 있다면 $tmp_subjects에서는 삭제
									 */ 
									foreach($tmp_subjects as $key_subject => $var_subject) {

										if(strpos($config_var['dir'], $var_subject) !== false) {

											unset($tmp_subjects[$key_subject]);

										}

									}

                                    unset($config_var['dir']);
									$tmp_array = array_merge_recursive((array)$config_var,		(array)$tmp_array);

                                }

                            }

							foreach ($tmp_subjects as $key => $var) {

								$subjects_final['dc_subject'][$key]    = $var;
								$subjects_final['dc_subject_id'][$key] = 'NA';

							}

							$tmp_array = array_merge_recursive((array)$subjects_final,	(array)$tmp_array);

                        }

						$arg['meta'] = $tmp_array;
						unset($subjects_final);
						unset($tmp_subjects);
						unset($tmp_array);

                        // 파일 확장자
                        $tmp_extension = strtolower($file_info['extension']);
                        switch($tmp_extension) {

                            // 그림 화일
                            case 'jpeg':
                            case 'jpg':
                            case 'gif':
                            case 'png':
                                // 참고 $exif로 들어오는 값들
                                // $exif[COMPUTED] = array(Height, Width, ApertureFNumber(ie. f/2.4), Thumbnail.FileType, Thumbnail.MimeType)
                                // $exif = array(Make, Model, ISOSpeedRatings(ie.100), ExposureTime(ie.1/60), FNumber(ie.24/10), DateTimeOriginal, DateTimeDigitized, Flash(ie.1)
                                $exif = @exif_read_data($each_file);
                                $tmp  = explode("/", $exif['MimeType']);
                                $arg['meta']['dc_type'][] = $tmp[0];

                                $arg['meta']['dc_format'][] = $exif['MimeType'];
                                unset($tmp);

                                // exif에 들어있는 YYYY:MM:DD 형식을 YYYY-MM-DD 형식으로 바꿈 : bisaz
                                $tmp1 = array();
                                $tmp1 = explode(" ", $exif['DateTimeOriginal']);
                                $tmp2 = explode(":", $tmp1[0]);
                                // 촬영일
                                $tmp_date = $tmp2[0] . '-' . $tmp2[1] . '-' . $tmp2[2] . ' ' . $tmp1[1];
                                // 촬영일이 없을 경우 화일작성 시간
                                $tmp_date = $exif['DateTimeOriginal'] ? $tmp_date : date('Y-m-d H:i:s', filemtime($each_file));
                                $arg['meta']['dc_date'][]    = $tmp_date;
								$arg['meta']['dc_created'][] = $tmp_date;

                                unset($tmp1,$tmp2,$tmp_date);

                                break;

                            // 마크다운 화일
                            case 'md':
                            case 'txt':
                                // 첫째줄을 제목으로
                                $fp  = fopen($each_file, "r");
                                $tmp = fgets($fp);

                                $title = str_replace("\n", '', $tmp);
                                fclose($fp);
                                // date값은 화일 작성일을 입력
                                $tmp_date = date('Y-m-d H:i:s', filemtime($each_file));
                                $arg['meta']['dc_date'][] = $tmp_date;
								$arg['meta']['dc_created'][] = $tmp_date;

                                unset($tmp_date);

                                break;

                        }

                        // 화일형식 값이 없을 경우 확장자에 따라 형식 지정
                        if(empty($arg['meta']['dc_format'][0])) {
                            switch($tmp_extension) {
                                case 'jpeg':
                                case 'jpg':
                                    $arg['meta']['dc_format'][0] = 'image/jpeg';
                                    break;
                                case 'gif':
                                    $arg['meta']['dc_format'][0] = 'image/gif';
                                    break;
                                case 'png':
                                    $arg['meta']['dc_format'][0] = 'image/png';
                                    break;
                                case 'md':
                                    $arg['meta']['dc_format'][0] = 'text/markdown';
                                    break;
                                case 'txt':
                                    $arg['meta']['dc_format'][0] = 'text/plain';
                                    break;
                            }
                        }

                        unset($tmp_extension);

                        { // BLOCK:value_set_dc:20131217:더블린 코어에 들어갈 값들 지정

                            $save_dir_dc   = $file_info['dirname'] . '/';

                            $title = $title ? $title : $file_info['filename'];
                            // UID값 지정
                            $arg['meta']['dc_identifier'][] = 'mapc ' . mapc_string_key_gen(20);
                            // 화일명
                            $arg['meta']['rdf_about']  = $file_info['basename'];
                            // 제목
                            $arg['meta']['dc_title'][] = $title;
                            // 화일을 불러올때는 원본이 언어로 되어있는지 모르니 무조건 기본언어로 등록 // #TODO 어떤 언어로 되어있는지 조사해서 입력...
                            $arg['meta']['dc_lang'][]  = $CONFIG['lang'];
							$arg['meta']['dc_modified'][] = date('Y-m-d H:i:s');

                            unset($tmp_file_info);
                            unset($exif);

                        } // BLOCK

                        { // BLOCK:dc_file_make:2012080901:메타데이타(더블린코어) 파일 생성

							if($scrap_option_rdf == 'rdf') {

	                            module_mapc_dc_make($file_info['basename'] . '.rdf', $arg['meta'], $save_dir_dc);

		                        $count_rdf_make++;

							}

                            unset($arg['meta']);
                            unset($title);

                        } // BLOCK

                    }

                    unset($post_info);
                    unset($dc_info);
                    unset($option);

                }

            }

            break;
    
    } // switch($ARGS['scrap_type'])

} // Model : Tail

// ======================================================================

{ // View : Head

	echo 'SCRAP FINISH!!!';
    echo '<br />';
    echo 'RDF Make : ' . $count_rdf_make;
    echo '<br />';
    echo 'RDF to DB : ' . $count_rdf_to_db;
    exit;
    $section_file = $PATH['module']['skin'] . 'scrap.view.php';

} // View : Tail

// end of file
