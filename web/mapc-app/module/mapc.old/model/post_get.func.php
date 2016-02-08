<?php
/**
 * UID값에 맞는 파일명 가져오기
 *
 * @param string $uid 고유값
 */
function module_mapc_post_get($uid, $lang='', &$option = array()) {

    global $CONFIG_DB;

	$query = 'SELECT post_seq, post_uid, post_lang, post_title, post_content, post_origin_type, post_origin_url, post_write_date, post_edit_date_latest FROM ' . $CONFIG_DB['prefix'] . 'mapc_post WHERE post_uid = ? ';

    $var    = array();
    $var[0] = $uid;

    if(! empty($lang)) {
        $query  .= '  and post_lang = ? ';
        $var[1]  = $lang;
    }

	$sth = $CONFIG_DB['handler']->prepare($query);
	$sth->execute( $var );

	$return = $sth->fetch(PDO::FETCH_ASSOC);

	return $return;

}

// end of file
