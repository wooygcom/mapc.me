<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 편집
 */

require(INIT_PATH . 'common.head.init.php');
{ // Model : Head

	{ // BLOCK:set_var:2012082201:입력값 체크 & 초기값 설정

		include_once(LIBRARY_PATH . 'mapc/string_key_gen.php');

		// hmmmmmmmmmnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnll <- 절대 지우지 마세요. ㅎㅎㅎㅎㅎ (사연이 있는 주석)

		$arg = array();
        $arg['uid']      = (!empty($_POST['dc_identifier'])) ? $_POST['dc_identifier'] : mapc_string_key_gen(16);
        $arg['title']    = (!empty($_POST['post_title']))    ? $_POST['post_title']    : '';
        $arg['content']  = (!empty($_POST['post_content']))  ? $_POST['post_content']  : '';
        $arg['meta']     = (!empty($_POST['meta']))  ? $_POST['meta'] : '';

		$arg['date']     = gmdate('Y-m-d H:i:s P');
		$arg['date_utc'] = gmdate('Y-m-d H:i:s');

		$arg['dbh'] = $CONFIG_DB['handler'];

	} // BLOCK


    // #TODO user모듈이용해서 로그인한 사용자에 대한 정보 가져오기 (id, displayname 따위)
	{ // BLOCK:personal_info_get:2013-01-18:로그인한 사용자에 대한 처리

	} // BLOCK


	{ // BLOCK:dc_insert:2012080901:메타데이터 입력

	    if(empty($_POST['dc_identifier'])) {
	       $is_new_post = TRUE;
        }

       // 새로등록 할 경우
	   if($is_new_post) {

			foreach($_FILES['post_file']['name'] as $key => $var) {

				$save_dir    = $PATH['mapc']['data'] . $arg['meta']['mapc_directory'];
				$upload_file = basename($_FILES['post_file']['name'][$key]);
                $file_info   = pathinfo($upload_file);
                $ext         = $file_info['extension'];
                $final_file  = $save_dir . $arg['uid'] . '.' . $ext;

                // 디렉토리가 없을 경우 생성
                if(!is_dir($save_dir)){
                    @mkdir($save_dir, 0777);
                }

				if (move_uploaded_file($_FILES['post_file']['tmp_name'][$key], $final_file)) {

					echo "Done.\n";

				} else {

					print "Error!\n";

				}

			}

    		$query = "
    			INSERT `mapc_post`
    			   SET `post_uid`     = '" . $arg['uid'] . "' 
    				 , `post_title`	  = '" . $arg['title'] . "'
    				 , `post_content` = '" . $arg['content'] . "'
					 , `post_write_date` = '". $arg['date'] . "'
    			";

            if($arg['dbh']->exec($query)){

                foreach($arg['meta'] as $key => $var) {

					if(!empty($var)) {

						$query = "";
						$query = "
							INSERT INTO mapc_postmeta
							   SET postmeta_post_uid = ?
								 , postmeta_key      = ?
								 , postmeta_value    = ?
							";

						$res = $arg['dbh']->prepare($query);
						$res->execute(array($arg['uid'], $key, $var));

					}

                }

            }

        }

	} // BLOCK


	{ // BLOCK:dc_file_make:2012080901:더블린코어 파일 생성

		$fp = fopen($save_dir . $arg['uid'].'.rdf', 'w');

		$doc = new DOMDocument('1.0', 'utf-8');
		$doc->formatOutput = true;

		$root = $doc->createElement('rdf:RDF');
		$doc->appendChild($root);

		$root_attr = $doc->createAttribute('xmlns:rdf');
		$root_attr->value = 'http://www.w3.org/1999/02/22-rdf-syntax-ns#';
		$root->appendChild($root_attr);
		$root_attr = $doc->createAttribute('xmlns:dc');
		$root_attr->value = 'http://purl.org/dc/elements/1.1/';
		$root->appendChild($root_attr);

		$desc = $doc->createElement('rdf:Description');
		$root->appendChild($desc);

		$desc_attr = $doc->createAttribute('rdf:about');
		$desc_attr->value = $rdf['about'];
		$desc->appendChild($desc_attr);

		$identifier = $doc->createElement('dc:identifier', $arg['uid']);
		$identifier = $desc->appendChild($identifier);

		$title = $doc->createElement('dc:title', $arg['title']);
		$title = $desc->appendChild($title);

		$subject = $doc->createElement('dc:subject', $arg['meta']['dc_subject']);
		$subject = $desc->appendChild($subject);

		$description = $doc->createElement('dc:description', $arg['meta']['dc_description']);
		$description = $desc->appendChild($description);

		$contributor = $doc->createElement('dc:contributor', $arg['meta']['dc_contributor']);
		$contributor = $desc->appendChild($contributor);

		$language = $doc->createElement('dc:language', $arg['meta']['dc_language']);
		$language = $desc->appendChild($language);

		$format = $doc->createElement('dc:format', $arg['meta']['dc_format']);
		$format = $desc->appendChild($format);

		$type = $doc->createElement('dc:type', $arg['meta']['dc_type']);
		$type = $desc->appendChild($type);

		$date = $doc->createElement('dc:date', $arg['meta']['dc_date']);
		$date = $desc->appendChild($date);

		$creator = $doc->createElement('dc:creator', $arg['meta']['dc_creator']);
		$creator = $desc->appendChild($creator);

		$publisher = $doc->createElement('dc:publisher', $arg['meta']['dc_publisher']);
		$publisher= $desc->appendChild($publisher);

		$relation = $doc->createElement('dc:relation', $arg['meta']['dc_relation']);
		$relation = $desc->appendChild($relation);

		$source = $doc->createElement('dc:source', $arg['meta']['dc_source']);
		$source = $desc->appendChild($source);

		$rights = $doc->createElement('dc:rights', $arg['meta']['dc_rights']);
		$rights = $desc->appendChild($rights);

		$coverage = $doc->createElement('dc:coverage', $arg['meta']['dc_coverage']);
		$coverage = $desc->appendChild($coverage);

		$creator = $doc->createElement('dc:creator', $arg['meta']['dc_creator']);
		$creator = $desc->appendChild($creator);

		$contents = $doc->saveXML();

		fwrite($fp, $contents);
		fclose($fp);

	} // BLOCK

?>
 
<?php
// =============================================================================================
echo $query;
print_r($_POST);
exit;

	{ // BLOCK|dc_insert|2012080901|더블린 코어 DB에 입력, 또는 수정

		$query = "
			REPLACE INTO mapc_article
			   SET dc_identifier  = '".$dc['identifier']."'
				 , dc_title       = '".$dc['title']."'
				 , dc_subject     = '".$dc['subject']."'
				 , dc_description = '".$dc['description']."'
				 , dc_contributor = '".$dc['contributor']."'
				 , dc_language    = '".$dc['language']."'
				 , dc_format      = '".$dc['format']."'
				 , dc_type        = '".$dc['type']."'
				 , dc_date        = '".$dc['date']."'
				 , dc_creator     = '".$dc['creator']."'
				 , dc_publisher   = '".$dc['publisher']."'
				 , dc_relation    = '".$dc['relation']."'
				 , dc_source      = '".$dc['source']."'
				 , dc_rights      = '".$dc['rights']."'
				 , dc_coverage    = '".$dc['coverage']."'
				 , rdf_about      = '".$rdf['about']."'
			";

		$g_dbh->exec($query);

		if($is_succ) {
			$msg = $LANG['suc_submit'];
		} else {
			$msg = $LANG['err_submit'];
		}

	} // BLOCK

	{ // BLOCK:contents_insert:20120815:내용 집어넣기...

		// #todo mapc_contents의 형태를 변경
		// #todo markdown형태인지, creole인지, docbook인지, html인지... 확인한 다음 docbook형태로
		// 원본은 확장자만 바꿔서 저장... docbook형태로 또한번 저장
		// data디렉토리에는 컨텐츠코드.dc(더블린코어), 컨텐츠코드.dbk(닥북), 컨텐츠코드.확장자(텍스트이외의 파일업로드일 경우)
		// #todo
		// 컨텐츠UID.언어코드.1.dc
		// 컨텐츠UID.언어코드.1.file (여러개 업로드했을 때에는 순차적으로 증가 2.3.4.5....)
		// 원래 하나의 파일에 하나의 dc를 적용시킬까 했었는데 똑같은 내용의 여러개 파일들을 올리는 경우가 많아서... ^^
		

		// #todo 사용자별로 data디렉토리 지정
		// 지금은 임시로 default안에 저장되도록 했지만, data/mapc/사용자ID/ 안에 저장되도록 해야 됨
		$fp = fopen($save_dir . $dc['identifier'].'.dbk', 'w');

		$doc = new DOMDocument('1.0', 'utf-8');
		$doc->formatOutput = true;

		$root = $doc->createElement('article');
		$doc->appendChild($root);

		$root_attr = $doc->createAttribute('version');
		$root_attr->value = '5.0';
		$root->appendChild($root_attr);
		$root_attr = $doc->createAttribute('xmlns');
		$root_attr->value = 'http://docbook.org/ns/docbook';
		$root->appendChild($root_attr);
		$root_attr = $doc->createAttribute('xmlns:xlink');
		$root_attr->value = 'http://www.w3.org/1999/xlink';
		$root->appendChild($root_attr);
		$root_attr = $doc->createAttribute('xmlns:xi');
		$root_attr->value = 'http://www.w3.org/2001/XInclude';
		$root->appendChild($root_attr);
		$root_attr = $doc->createAttribute('xmlns:svg');
		$root_attr->value = 'http://www.w3.org/2000/svg';
		$root->appendChild($root_attr);
		$root_attr = $doc->createAttribute('xmlns:m');
		$root_attr->value = 'http://www.w3.org/1998/Math/MathML';
		$root->appendChild($root_attr);
		$root_attr = $doc->createAttribute('xmlns:db');
		$root_attr->value = 'http://docbook.org/ns/docbook';
		$root->appendChild($root_attr);

		$info = $doc->createElement('info');
		$root->appendChild($info);

			$title = $doc->createElement('title', $dc['title']);
			$title = $info->appendChild($title);

////////////////////////////////////////////////////////////////////////////////////////////////////
		// #todo
		// 기존의 Head태그보다
		// 같은 값이면 section 닫고 section 다시 열기
		// 하위 값이면 section 그대로 두고 section 열기
		// 높은 값이면 값의 차이만큼 section 닫기 <h3>3번제목</h3><p>내용</p><h1>1번제목</h1>
		// <- 여기서처럼 h1이 나올때 </section>(h3) </section>(h2) </section>(기존 h1) <section>(h1 시작)
		// $sect = $doc->createElement('sect');
		// $root->appendChild($sect);
		include_once( LIBRARY_PATH . 'htmlParser.class.php' );

		$parser        = new htmlParser($mapc_contents);
		$html_ar       = $parser->toArray();
		$order_count   = 1;
		$current_level = 1;

		foreach($html_ar as $key => $var) {

			// 현재 깊이값(depth)이 1이거나 이전 깊이값이 설정되지 않았을 때 새로운 section을 만든다.
			if($current_level == 1) {

				$parent_elem = $doc;
				$sect[$order_count][$current_level] = $parent_elem->createElement('section');
				$sect[$order_count][$current_level] = $root->appendChild($sect[$order_count][$current_level]);

				$order_count++;

			// #todo 현재값이 2이상 일 때 부모요소($parent_elem)를 $section1, $section2따위 로 설정
			} else {

				$parent_elem = $sect[$order_count][($before_level - $current_level)]; // $before_elem;

			}

			switch($var['tag']) {

			case 'h1':
			case 'h2':
			case 'h3':
			case 'h4':
			case 'h5':
			case 'h6':

				$current_level	= substr($var['tag'], 1);
/*
				$sect = $parent_elem->createElement('title', $var['innerHTML']);
				$root->appendChild($sect);
*/
				// 현재 태그의 깊이(depth)를 저장
				$before_level	= $current_level;
				// 현재 section Element를 저장
//				$section{$current_level} = $sect;

				break;

			case 'p':

				$para = $parent_elem->createElement('para', $var['innerHTML']);
				$root->appendChild($para);
				break;

			}

		}

//*/

		$contents = $doc->saveXML();

		fwrite($fp, $contents);
		fclose($fp);

/*
  <info>
    <title>섹션 이름</title>

    <author>
      <personname><firstname>이름</firstname><surname>성</surname></personname>

      <affiliation>
        <orgname>발행기관</orgname>
      </affiliation>
    </author>

    <pubdate>2012-09-01</pubdate>
  </info>

  <section>
    <title>섹션 타이틀</title>

    <para>내용들어가는 곳</para>
  </section>
</article>
*/

	} // BLOCK

} // Model : Tail
require(INIT_PATH.'common.tail.init.php');

// ======================================================================

{ // View : Head

	include_once(LIB_PATH.'js.message.func.php');

	$head = jsMessage($msg, 'refresh');

	include($TPLP['core'].'layout_content.tpl.php');

} // View : Tail

// end of file
