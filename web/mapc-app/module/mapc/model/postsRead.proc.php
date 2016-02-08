<?php
/**
 *
 * 글 정보들 읽어오기
 *
 * @param string $ARGS['id'] 불러올 글의 ID
 * @param string $CONFIG_DB['type']    DB 종류(mysql, oracle, etc)
 * @param string $CONFIG_DB['handler'] DB Handler
 * @param string $_SESSION['locale']   언어 설정
 * @param string $mapcConfig['crud']['table'] 테이블 이름
 * @param string $mapcConfig['crud']['read']  테이블에서 읽을 필드
 *
 * @return array $post['main'] 글 원문
 * @return array $post['meta'] 메타 자료
 *
 */

    { // BLOCK:post_get:20130921:기본정보 가져오기

        include_once(LIBRARY_PATH . 'crud/read.func.php');
        $post['main'] = Mapc\Library\Crud\crudRead([
            'dbType' => $CONFIG_DB['type'],
            'dbh'    => $CONFIG_DB['handler'],
            'table'  => $mapcConfig['crud']['table'],
            'fields' => $mapcConfig['crud']['read'],
            'keyField' => 'post_uid',
            'keyValue' => $ARGS['id']
        ]);

    } // BLOCK

    { // BLOCK:postmeta_get:20130921:메타정보 가져오기

        include_once(LIBRARY_PATH . 'crud/list.func.php');
        $post['meta'] = Mapc\Library\Crud\crudList([
            'dbType' => $CONFIG_DB['type'],
            'dbh'    => $CONFIG_DB['handler'],
            'table'  => $mapcConfig['meta']['table'],
            'fields' => $mapcConfig['meta']['list'],
            'where'  => ' postmeta_post_uid = :post_uid ',
            'whereValue' => ['post_uid' => $ARGS['id']]
        ])['lists'];

    } // BLOCK

// end of file
