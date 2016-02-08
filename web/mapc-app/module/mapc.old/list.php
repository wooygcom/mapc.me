<?php
if(!defined('__MAPC__')) { exit(); }

/**
 *
 * 글목록
 *
 * @param string $parent_file 외부에서 include될 경우 parent의 __FILE__ 값
 *
 */

require_once(INIT_PATH.'init.db.php');

{ // Model : Head

    { // BLOCK:include_library:2013-01-18

        // $arg['user_dir'], $arg['data_dir'] return (private directory of logged in user)
        include_once($config['path']['root'] . 'model/path_get_per_user.proc.php');

    } // BLOCK

    { // BLOCK:list_get:20131101:리스트 가져오기

        // make_search_query:20140101:검색 조건에 따라서 넘김값 만들기
        include_once($config['path']['root'] . 'model/search_arg.proc.php');

        $query = "
            SELECT SQL_CALC_FOUND_ROWS post_uid, post_lang, post_title, post_content, post_origin_type, post_origin_url, post_write_date, post_user_uid, post_user_name
              FROM " . $CONFIG_DB['prefix'] . "mapc_post " . $search_query .
            " ORDER BY post_write_date DESC LIMIT :page, :pageSet
            ";

        $sth       = $CONFIG_DB['handler']->prepare($query);

        $mapc_page = $_REQUEST['mapc_page'] ? (int)$_REQUEST['mapc_page'] : 1;
        $page      = ($mapc_page - 1) * $pageSet;

        $sth->bindParam(':page',    $page,    PDO::PARAM_INT);
        $sth->bindParam(':pageSet', $pageSet, PDO::PARAM_INT);

        // 검색값 넣기 #ID:ab9102312
        include($config['path']['root'] . 'model/search_var.proc.php');

        $sth->execute();

        // 페이징에 필요한 전체 갯수 구하기
        $arg['total'] = $CONFIG_DB['handler']->query('SELECT FOUND_ROWS();')->fetch(PDO::FETCH_COLUMN);
        // $arg['total'], $page, $page_set;
        // $arg['total'] - (($page - 1) * $page_set)

        while($result = $sth->fetch(PDO::FETCH_ASSOC)) {

            // 게시판 글번호 정하기...
            $result['post_num'] = $arg['total'] - (($mapc_page - 1) * $pageSet) - $i;
            $i++;

            $tmp = explode("/", $result['post_origin_type']);
            $result['file_type'] = $tmp[0];
            unset($tmp);
            $result['file_url'] = $PATH['mapc']['data'] . $result['post_origin_url'];

            // 메타데이터 가져오기 // #TODO DB가 아니라 화일이나 다른 서버에서 가져오도록...
            $query_meta = '
                select postmeta_post_uid, postmeta_key, postmeta_value
                  from ' . $CONFIG_DB['prefix'] . 'mapc_postmeta
                 where postmeta_post_uid = :mapc_uid
                ';

            $sth_meta = $CONFIG_DB['handler']->prepare($query_meta);
            $sth_meta->bindParam(':mapc_uid', $result['post_uid']);
            $sth_meta->execute();

            while($tmp_result = $sth_meta->fetch(PDO::FETCH_ASSOC)) {

                $result['meta'][$tmp_result['postmeta_key']][] = $tmp_result['postmeta_value'];

            }

            $return['post_list'][] = $result;
        }

    } // BLOCK

    { // BLOCK:set_sub_section-paging:20131028:페이징 출력

        include_once(MODULE_PATH . 'paging/config/config.php');
        include_once(MODULE_PATH . 'paging/model/paging_gen.func.php');
        include_once(LIBRARY_PATH .'mapc/file_skin_include.func.php');

        $arg['page']     = $mapc_page ? $mapc_page : 1;
        $arg['page_key'] = 'mapc_page';
        $arg['pageSet']  = $pageSet;
        $arg['url']      = $URL['mapc']['list'] . $url_search_addition;

        $paging = module_paging_gen($arg);

        $PATH['_paging'] = $PATH['paging']['root'] . 'view/basic/paging.view.php';
        $return['_paging'] = $paging;

    } // BLOCK

} // Model : Tail

// ======================================================================

{ // View : Head

    $return['mapc_cate'] = $mapc_cate;
    
    // $mapc_cate 값에 따라 출력형식 지정하기
    switch($mapc_cate) {
        case 'date':
            // fullcalendar
            $return['head']['css']['fullcalendar.css']       = $URL['core']['root'] . 'vendor/fullcalendar/dist/';
            $return['head']['css']['fullcalendar.print.css'] = $URL['core']['root'] . 'vendor/fullcalendar/dist/';
            $return['head']['js']['moment.min.js']           = $URL['core']['root'] . 'vendor/fullcalendar/dist/';
            $return['head']['js']['fullcalendar.min.js']     = $URL['core']['root'] . 'vendor/fullcalendar/dist/';
            $skin_file = 'list_calenda';
            break;

        case 'shop':
        case 'image':
            $skin_file = 'list_album';
            break;

        default:
            $skin_file = 'list';
            break;
    }

    $return['section_file'] = $skin_file;

    if(! empty($parent_file) && $parent_file != __FILE__) {
        return $return;
    } else {
        $VIEW += $return;
        unset($return);
    }

} // View : Tail

// end of file
