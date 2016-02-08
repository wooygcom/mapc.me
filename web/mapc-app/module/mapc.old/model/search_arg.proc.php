<?php
/**
 *
 * 검색에 필요한 넘김값 만들기
 *
 */

if(!defined('__MAPC__')) { exit(); }

{ // BLOCK:search_query:20140101:입력값 체크

    // 출력 키워드(리스트, 앨범, 달력, 꼬리표(태그)리스트...)
    $mapc_cate   = $ARGS['mapc_cate'];

    // 검색 옵션
    $mapc_srch_title = $ARGS['mapc_srch_title'];
    $mapc_search_key = $ARGS['mapc_search_key'];
    $mapc_search     = $ARGS['mapc_search'];
    $mapc_srch_lang  = $ARGS['mapc_srch_lang']; // 기본 언어의 글들만 불러오게끔~

    $mapc_date_from  = $ARGS['mapc_date_from'];
    $mapc_date_to    = $ARGS['mapc_date_to'];

    // mapc_cate값에 따라서 가져올 자료 결정하기... 예를들어 앨범은 이미지화일만, 달력은 일정관련 게시물만
    switch($mapc_cate) {
        case 'image':
            $mapc_search[] = 'dc_format:image/jpeg';
            $mapc_search[] = 'dc_format:image/png';
            $mapc_search[] = 'dc_format:image/gif';
            $pageSet = 12; // 그림보기에 이쁘게 불러오는 갯수를 조정
            break;
        default:
            $pageSet = 10;
            break;
    }

} // BLOCK


{ // BLOCK:arg_search:20131123:검색관련 넘김값 만들기

    $url_search_addition = '';
    $url_search_addition.= 'mapc_srch_title/' . $mapc_srch_title . '/';
    $url_search_addition.= 'mapc_search_key/' . $mapc_search_key . '/';
    $url_search_addition.= 'mapc_date_from/'  . $mapc_date_from . '/';
    $url_search_addition.= 'mapc_date_to/'    . $mapc_date_to . '/';
    $url_search_addition.= 'mapc_cate/'       . $mapc_cate . '/';
    $url_search_addition.= 'mapc_srch_lang/'  . $mapc_srch_lang . '/';

    $key = $var = '';

    if(! empty($mapc_search)) {
        foreach($mapc_search as $key => $var) {
            $url_search_addition .= 'mapc_search[]/' . $var . '/';
        }
    }

} // BLOCK

/**
 *
 * 검색 쿼리 만들기
 * 아래와 같은 형태의 검색쿼리를 만듦
 * (type이 '그림'이고 주제가 '강아지'인 자료)
 *
 */

/*
// 검색쿼리 예제
    SELECT field from table
     WHERE post_uid IN (
         (
             SELECT tbl0.postmeta_post_uid
               FROM mapc_postmeta tbl0, mapc_postmeta tbl1
              WHERE (tbl0.postmeta_post_uid = tbl1.postmeta_post_uid)
                AND (
                      ( tbl0.postmeta_key = :search_key_0 and tbl0.postmeta_value = :search_var_0)
                ) AND (
                      ( tbl1.postmeta_key = :search_key_1 and tbl1.postmeta_value = :search_var_1)
                   OR ( tbl1.postmeta_key = :search_key_2 and tbl1.postmeta_value = :search_var_2)
                )
         )
     ) 
 */
{ // BLOCK:SEARCH:20131101:검색쿼리 만들기

    // 'WHERE'를 한번 써먹고 난 이후에는 $where_link를 'AND'로 바꿈
    $where_link   = $where_link ? $where_link : ' WHERE ';
    $search_query = '';

    if(! empty($mapc_search_key)) {
        $mapc_search[] = $mapc_search_key;
    }

    if(is_array($mapc_search)) {

        ksort($mapc_search);

        // 쿼리에 필요한 갯수(tbl0, tbl1, tbl2...)
        $i=0;
        $table_name = 'tbl' . $i;
        $search_query_start = " SELECT " . $table_name . ".postmeta_post_uid FROM " . $CONFIG_DB['prefix'] . "mapc_postmeta " . $table_name;

        foreach($mapc_search as $key => $var) {

            if(! empty($var)) {

                // 검색조건이 하나라도 있으면 true
                $search_bool = true;

                // 검색하려는 값(subject:lego = 검색키:주제, 검색값:레고)
                $search_value[$key] = explode(":", $var);

                // 이전 검색키값이 현재 검색조건과 다르면...AND 추가
                if(
                    ($search_value[$key][0] != $search_key_bf)
                 && (! empty($search_key_bf))
                ) {
                    $i++;
                    $table_name = 'tbl' . $i;
                    $search_condit = ' (tbl0.postmeta_post_uid = tbl1.postmeta_post_uid) AND ';
                    $search_query_table .= ' , ' . $CONFIG_DB['prefix'] . 'mapc_postmeta ' . $table_name;
                    $search_query .= ' ) AND ( ';
                    $temp_conn = '';
                }

                $search_key_bf = $search_value[$key][0];

                $search_query .= sprintf($temp_conn . ' ( ' . $table_name . '.postmeta_key   = :%s and ' . $table_name . '.postmeta_value = :%s) ', 'search_key_'.$key, 'search_var_'.$key);
                $temp_conn = ' OR ';

            }

        }

    }

    // 검색조건이 입력되었을 경우 Where 절 만들기
    if($search_bool) {

        $search_query = $where_link . "
            post_uid IN (
                 ( "
                 . $search_query_start . $search_query_table . ' WHERE ' . $search_condit . '( ' . $search_query . ' ) ' .
                 " )
            )
            ";
        $where_link = ' AND ';

    // 검색조건이 없으면 Where절 역시 만들지 않음
    } else {

        $search_query = '';

    }

    $search_date_from = '';
    $search_date_to   = '';

    if(! empty($mapc_srch_title)) {
        $search_query .= $where_link . " post_title like :mapc_title ";
        $where_link = ' AND ';
    }

    if(! empty($mapc_srch_lang)) {
        $search_query .= $where_link . " post_lang = :mapc_lang ";
        $where_link = ' AND ';
    }

    if($mapc_cate != 'date') { // 달력형태에서는  날짜별 검색이 필요없으므로...
        if(! empty($mapc_date_from)) {
            $search_query .= $where_link . " post_write_date >= :mapc_date_from ";
            $where_link = ' AND ';
        }

        if(! empty($mapc_date_to)) {
            $search_query .= $where_link . " post_write_date <= :mapc_date_to ";
            $where_link = ' AND ';
        }
    }

} // BLOCK

// this is it
