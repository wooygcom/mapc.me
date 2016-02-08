<?php
/**
 * 키 넣기...
 *
 * @param string $uid
 * @param string $meta
 * @param object $option['dbh'];
 * @param string $option['lang']; // 언어코드 (새로운 코드)
 * @param string $option['lang_before']; // 언어코드 (기존에 사용했던, 언어코드를 변경할 때에만 값이 들어옴(kr->kor 처럼)
 */
function module_mapc_postmeta_insert(&$uid, &$meta, &$option = array()) {

    global $CONFIG_DB;

    $lang        = $option['lang'];
    $lang_before = $option['lang_before'] ? $option['lang_before'] : $option['lang'];

    // #TODO UPDATE를 하는게 좋겠지만, 현재로서는 dc_identifier기준으로 기존자료 삭제 후 다시 입력
    $query = "
        delete from " . $CONFIG_DB['prefix'] . "mapc_postmeta where postmeta_post_uid = '" . $uid . "' and postmeta_lang = '" . $lang_before . "'
        ";

    $option['dbh']->exec($query);

	$query = "
		INSERT INTO " . $CONFIG_DB['prefix'] . "mapc_postmeta
		   SET postmeta_lang     = ?
             , postmeta_post_uid = ?
			 , postmeta_key      = ?
			 , postmeta_value    = ?
			 , postmeta_etc      = ?
		";

	$res = $option['dbh']->prepare($query);

	foreach($meta as $meta_key => $meta_var) {

		// var가 배열일 경우 foreach
		if(is_array($meta_var) || is_object($meta_var)) {

			foreach($meta_var as $key_sub => $var_sub) {

				if( strlen($var_sub) > 0 ) {
// #TODO NOW subject
/*
print_r($meta_var)
       [dc_subject] => Array
        (
            [0] => 주제1
            [1] => 주제2
        )
    [dc_subject_id] => Array
        (
            [0] => mapc:PUHAHAHAHAHAHA
            [1] => mapc:ETC123123123
        )
 */
                    $var_sub = str_replace('mapc:', '', $var_sub);
                    if((string)$meta_key == 'rdf_Description') {
                        $key1 = $key_sub;
                        $tmp  = $key_sub . '_count';
                        $key2 = $$tmp++;
                        if($key2 == null) { $key2 = 0; }

                    } else {
                        $key1 = $meta_key;
                        $key2 = $key_sub;
                    }

					$return  = $res->execute( array($lang, $uid, $key1, $var_sub, $key2) );

				}

			}

		// 아니면 그냥 insert
		} else {

			if( ! empty($meta_var) ) {

                $meta_var = str_replace('mapc:', '', $meta_var);
				$return   = $res->execute( array($lang, $uid, $meta_key, $meta_var, 0) );

			}

		}

	}

    return $return;

}

// this is it
