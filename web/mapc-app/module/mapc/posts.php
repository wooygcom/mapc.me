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

    { // BLOCK:get_config:20151226

        // module/모듈명/config/config.php
        $mapcConfig = include_once(__DIR__ . '/config/config.php');

    } // BLOCK

    { // BLOCK:get_data_path_per_user:2013-01-18

        // $arg['user_dir'], $arg['data_dir'] return (private directory of logged in user)
        include_once(__DIR__ . '/model/dataPathRead.func.php');

        // 자료디렉토리 상대주소
        $dataPath = Mapc\Module\Mapc\dataPathRead(DATA_PATH . 'mapc/', [
            'type' => $_SESSION['mapc_user_type'],
            'id'   => $_SESSION['mapc_user_uid']
        ]);

        // 자료디렉토리 절대주소
        $dataPathAbs = DATA_PATH . 'mapc/' . $dataPath;

    } // BLOCK

    { // BLOCK:list_get:20131101:리스트 가져오기

        $page    = $_REQUEST['mapc-page'] ? $_REQUEST['mapc-page'] : 1;
        $pageSet = ($pageSet) ? $pageSet : 10;
        $current = $_REQUEST['current'] ? $_REQUEST['current'] : 1; // 현재 페이지

        // make_search_query:20140101:검색 조건에 따라서 넘김값 만들기 ($where, $whereValue)
        $where = include_once(__DIR__ . '/model/searchArg.proc.php');

        include_once(LIBRARY_PATH . 'crud/list.func.php');
        $temp = Mapc\Library\Crud\crudList([
            'dbType' => $CONFIG_DB['type'],
            'dbh'    => $CONFIG_DB['handler'],
            'table'  => $mapcConfig['crud']['table'],
            'fields' => $mapcConfig['crud']['list'],
            'where'  => $where,
            'whereValue' => $whereValue,
            'orderBy'=> 'post_write_date DESC',
            'page'   => $page,
            'pageSet'=> $pageSet
        ]);
        $return['posts'] = $temp['lists'];
        $total           = $temp['total'];
        unset($temp);



//    $result['file_url'] = $PATH['mapc']['data'] . $result['post_origin_url'];

/*
// #TODO

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

*/

    } // BLOCK

    { // BLOCK:set_sub_section-paging:20131028:페이징 출력

        $pagingConfig = include_once(MODULE_PATH . 'paging/config/config.php');

        include_once(MODULE_PATH  . 'paging/model/pagingGen.func.php');
        include_once(LIBRARY_PATH .'mapc/file_skin_include.func.php');

        $paging = Mapc\Module\Paging\pagingGen([
            // 글의 총합계
            'total'   => $total,
            'page'    => $page,
            'pageKey' => 'mapc-page',
            'pageSet' => $pageSet,
            'url'     => $mapcConfig['url']['root'] . 'posts/' . $urlSearchAdd
        ]);

        $PATH['_paging'] = $pagingConfig['path']['root'] . 'view/basic/paging.view.php';
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
            $skin_file = 'posts.calenda';
            break;

        case 'shop':
        case 'image':
            $skin_file = 'posts.album';
            break;

        default:
            // PASS
            break;
    }

    $return['section_file'] = $skin_file;

    if($ARGS['page'] == 'posts' && empty($ARGS['admn'])) {
        $VIEW += $return;
        unset($return);
    } else {
        return $return;
    }

} // View : Tail

// end of file
