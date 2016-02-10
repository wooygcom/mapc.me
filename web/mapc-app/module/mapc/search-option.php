<?php
if(!defined('__MAPC__')) { exit(); }

require_once(INIT_PATH . 'init.db.php');

{ // MODEL:Head

    { // BLOCK:set_sub_section-search_option:20151124:검색할 태그,주제,포맷 값들 리스트 가져오기 (리스트 화면 검색 옵션에 출력하기 위함)

        // #TODO 검색속도를 위해서 DB에서 긁어오는게 아니라 텍스트화일(검색옵션.txt 또는 검색옵션.php) 만들어두고 거기서 검색옵션을 가져오게끔~ 새글이 등록되면 검색옵션.php도 변경되게끔하고~
        $so_query = "
            SELECT distinct postmeta_key, postmeta_value
              FROM " . $CONFIG_DB['prefix'] . "mapc_postmeta
             WHERE postmeta_key = :searchKey
            ";

        $so_sth = $CONFIG_DB['handler']->prepare($so_query);

        $so_search_key = 'dc_subject';
        $so_sth->bindParam(':searchKey', $so_search_key, PDO::PARAM_STR);
        $so_sth->execute();
        $return['dc_subject'] = $so_sth->fetchAll(PDO::FETCH_ASSOC);

        $so_search_key = 'dc_type';
        $so_sth->bindParam(':searchKey', $so_search_key, PDO::PARAM_STR);
        $so_sth->execute();
        $return['dc_type'] = $so_sth->fetchAll(PDO::FETCH_ASSOC);

        $so_search_key = 'dc_format';
        $so_sth->bindParam(':searchKey', $so_search_key, PDO::PARAM_STR);
        $so_sth->execute();
        $return['dc_format'] = $so_sth->fetchAll(PDO::FETCH_ASSOC);

        $so_search_key = 'dc_language';
        $so_sth->bindParam(':searchKey', $so_search_key, PDO::PARAM_STR);
        $so_sth->execute();
        $return['dc_language'] = $so_sth->fetchAll(PDO::FETCH_ASSOC);

        $so_search_key = 'dc_coverage';
        $so_sth->bindParam(':searchKey', $so_search_key, PDO::PARAM_STR);
        $so_sth->execute();
        $return['dc_coverage'] = $so_sth->fetchAll(PDO::FETCH_ASSOC);

    } // BLOCK

} // MODEL

{ // VIEW:Head

    if($ARGS['page'] == 'search-option') {
        $VIEW += $return;
        unset($return);
    } else {
        return $return;
    }

} // VIEW:Foot

// end of file