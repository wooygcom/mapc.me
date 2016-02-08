<?php
/**
 * 검색값이 있을 경우 검색값을 쿼리에 집어넣기
 */
if(! empty($search_value)) {
    foreach($search_value as $key => $var) {
        $sth->bindParam(':search_key_'.$key, $var[0]);
        $sth->bindParam(':search_var_'.$key, $var[1]);
    }
}
// 언어 검색
if(! empty($mapc_srch_title)) {
    $temp = '%' . $mapc_srch_title . '%';
    $sth->bindParam(':mapc_title', $temp);
    unset($temp);
}
// 언어 검색
if(! empty($mapc_srch_lang)) {
    $sth->bindParam(':mapc_lang', $mapc_srch_lang);
}

if($mapc_cate != 'date') { // 달력형태에서는  날짜별 검색이 필요없으므로...
     
    // 시작일 검색
    if(! empty($mapc_date_from)) {
        $sth->bindParam(':mapc_date_from', $mapc_date_from);
    }
    // 종료일 검색
    if(! empty($mapc_date_to)) {
        $temp = $mapc_date_to . ' 23:59:59'; // 종료일은 시간까지 추가해줘야 검색이 되기 때문에...
        $sth->bindParam(':mapc_date_to',   $temp);
        unset($temp);
    }

}

// this is it
