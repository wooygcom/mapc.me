<?php
/**
 *
 * 검색에 필요한 넘김값 만들기
 *
 */

if(!defined('__MAPC__')) { exit(); }

{ // BLOCK:search_query:20140101:입력값 체크

    // 출력 키워드(리스트, 앨범, 달력, 꼬리표(태그)리스트...)
    $mapcCate   = $_REQUEST['mapc-cate'];

    /**
     * 검색 옵션
     */
    // Title
    $mapcSearch     = $_REQUEST['mapc-search'];

    $mapcSearchTitle = $_REQUEST['mapc-srch-title'];
    $mapcSearchLang  = $_REQUEST['mapc-srch-lang'];
    $mapcDateFrom    = $_REQUEST['mapc-date-from']; // 게시일 검색범위 시작일
    $mapcDateTo      = $_REQUEST['mapc-date-to'];   // 게시일 검색범위 마감일

    // mapc_cate값에 따라서 가져올 자료 결정하기... 예를들어 앨범은 이미지화일만, 달력은 일정관련 게시물만
    switch($mapcCate) {
        case 'image':
            $mapcSearch[] = 'dc_format:image/jpeg';
            $mapcSearch[] = 'dc_format:image/png';
            $mapcSearch[] = 'dc_format:image/gif';
            $pageSet = 12; // 그림보기에 이쁘게 불러오는 갯수를 조정
            break;
        default:
            $pageSet = 10;
            break;
    }

} // BLOCK


{ // BLOCK:arg_search:20131123:검색관련 넘김값 만들기

    $urlSearchAdd = '';
    $urlSearchAdd.= '&mapc-srch-title=' . $mapcSearchTitle;
    $urlSearchAdd.= '&mapc-date-from='  . $mapcDateFrom;
    $urlSearchAdd.= '&mapc-date-to='    . $mapcDateTo;
    $urlSearchAdd.= '&mapc-cate='       . $mapcCate;
    $urlSearchAdd.= '&mapc-srch-lang='  . $mapcSearchLang;

    $key = $var = '';

    if(! empty($mapcSearch)) {
        foreach($mapcSearch as $key => $var) {
            $urlSearchAdd .= '&mapc-search[]=' . $var;
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
                  ( tbl0.postmeta_key = :searchKey0 and tbl0.postmeta_value = :searchVar0)
            ) AND (
                  ( tbl1.postmeta_key = :searchKey1 and tbl1.postmeta_value = :searchVar1)
               OR ( tbl1.postmeta_key = :searchKey2 and tbl1.postmeta_value = :searchVar2)
            )
     )
 ) 

 */
{ // BLOCK:SEARCH:20131101:검색쿼리 만들기

    // $whereLink('WHERE' 또는 빈칸)를 한번 써먹고 난 이후에는 $whereLink를 'AND'로 바꿈
    $whereLink = $whereLink ? $whereLink : '';
    $where     = '';

    if(is_array($mapcSearch)) {

        ksort($mapcSearch);

        // 쿼리에 필요한 갯수(tbl0, tbl1, tbl2...)
        $i=0;
        $tableName = 'tbl' . $i;
        $whereStart = " SELECT " . $tableName . ".postmeta_post_uid FROM " . $CONFIG_DB['prefix'] . "mapc_postmeta " . $tableName;

        foreach($mapcSearch as $key => $var) {

            if(! empty($var)) {

                // 검색조건이 하나라도 있으면 true
                $searchBool = true;

                // 검색하려는 값(subject:lego = 검색키:주제, 검색값:레고)
                $searchValue[$key] = explode(":", $var);

                // 이전 검색키값이 현재 검색조건과 다르면...AND 추가
                if(
                    ($searchValue[$key][0] != $search_key_bf)
                 && (! empty($search_key_bf))
                ) {
                    $i++;
                    $tableName = 'tbl' . $i;
                    $search_condit = ' (tbl0.postmeta_post_uid = tbl1.postmeta_post_uid) AND ';
                    $whereTable .= ' , ' . $CONFIG_DB['prefix'] . 'mapc_postmeta ' . $tableName;
                    $where .= ' ) AND ( ';
                    $tempConnect = '';
                }

                $search_key_bf = $searchValue[$key][0];

                $where .= sprintf($tempConnect . ' ( ' . $tableName . '.postmeta_key   = :%s and ' . $tableName . '.postmeta_value = :%s) ', 'search_key_'.$key, 'search_var_'.$key);

                $var2 = explode(":", $var);
                $whereValue['search_key_'.$key] = $var2[0];
                $whereValue['search_var_'.$key] = $var2[1];

                $tempConnect = ' OR ';

            }

        }

    }

    // 검색조건이 입력되었을 경우 Where 절 만들기
    if($searchBool) {

        $where = $whereLink . "
            post_uid IN (
                 ( "
                 . $whereStart . $whereTable . ' WHERE ' . $search_condit . '( ' . $where . ' ) ' .
                 " )
            )
            ";
        $whereLink = ' AND ';

    // 검색조건이 없으면 Where절 역시 만들지 않음
    } else {

        $where = '';

    }

    $search_date_from = '';
    $search_date_to   = '';

    if(! empty($mapcSearchTitle)) {
        $where .= $whereLink . " post_title like :mapc_title ";
        $whereLink = ' AND ';
        $temp = '%' . $mapcSearchTitle . '%';
        $whereValue['mapc_title'] = $temp;
        unset($temp);
    }

    if(! empty($mapcSearchLang)) {
        $where .= $whereLink . " post_lang = :mapc_lang ";
        $whereLink = ' AND ';
        $whereValue['mapc_lang'] = $mapcSearchLang;
    }

    if($mapcCate != 'date') { // 달력형태에서는  날짜별 검색이 필요없으므로...

        if(! empty($mapcDateFrom)) {
            $where .= $whereLink . " post_write_date >= :mapc_date_from ";
            $whereLink = ' AND ';
            $whereValue['mapc_date_from'] = $mapcDateFrom;
        }

        if(! empty($mapcDateTo)) {
            $where .= $whereLink . " post_write_date <= :mapc_date_to ";
            $whereLink = ' AND ';
            $whereValue['mapc_date_from'] = $mapcDateTo;
        }

    }

    return $where;

} // BLOCK

// this is it
