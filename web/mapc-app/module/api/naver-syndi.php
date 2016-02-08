<?php
require_once(INIT_PATH . 'init.db.php');

include_once(MODULE_PATH . 'mapc/model/post_get.func.php');
include_once(MODULE_PATH . 'user/model/infoGet.func.php');

// 글의 고유값, Unique ID of article
$arg['mapc_uid']  = $arg['mapc_uid']  ? $arg['mapc_uid'] : $ARGS['mapc_uid'];
// 언어
$arg['mapc_lang'] = $arg['mapc_lang'] ? $arg['mapc_lang'] : $ARGS['mapc_lang'];

$post_info = module_mapc_post_get($arg['mapc_uid'], $arg['mapc_lang'], $option);
$temp_info = Mapc\Module\User\infoGet([
    'userUid' => $post_info['post_user_uid']
]);
$author    = $temp_info['user_name'];

// #TODO 게시판 그룹의 이름, 게시판의 이름, 우선은 글제목을...
$board_title  = $post_info['post_title'];

$title        = htmlspecialchars($post_info['post_title']);
$author       = htmlspecialchars($author);
$published    = date('Y-m-d\TH:i:s\+09:00', strtotime($post_info['post_write_date']));
$updated      = $published;
$link_href    = $URL['core']['root'] . 'mapc/view/mapc_uid/' . $arg['mapc_uid'];
$id           = $link_href . htmlspecialchars("&wr_id={$wr_id}");
$link_title   = htmlspecialchars($board_title);
$feed_updated = date('Y-m-d\TH:i:s\+09:00');

$find         = array('&amp;', '&nbsp;'); // 본문중의 html인코딩된 기호를 찾아서
$replace      = array('&', ' '); // 바꾼다

$content      = str_replace( $find, $replace, $post_info['post_content'] );
$summary      = str_replace( $find, $replace, strip_tags($post_info['post_content']) );

Header("Content-type: text/xml");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

echo '<?xml version="1.0" encoding="utf-8"?>'; // <?xml 태그를 php코드로 인식해버리는 바람에 echo 문 사용...

?>
<feed xmlns="http://webmastertool.naver.com">
    <id><?= $URL['core']['abs_root']; ?></id>
    <title><?= $CONFIG['meta']['title']; ?></title>
    <author>
    <name><?= $CONFIG['admin']['name']; ?></name>
    <email><?= $CONFIG['admin']['email']; ?></email>
    </author>
    <updated><?= $feed_updated; ?></updated>
    <link rel="site" href="<?= $URL['core']['abs_root']; ?>" title="<?= $CONFIG['meta']['title']; ?>" />
    <entry>
        <id>
            <?= $URL['core']['abs_root']; ?>
        </id>
        <title>
            <![CDATA[<?= $title; ?> ]]>
        </title>
        <author>
            <name><?= $author; ?></name>
        </author>
        <updated><?= $updated; ?></updated>
        <published><?= $published; ?></published>
        <content type="html">
            <![CDATA[<?= $content; ?>]]>
        </content>
        <summary type="text">
            <![CDATA[<?= $summary; ?>]]>
        </summary>
        <category term="<?= $mapc_cate; ?>" label="<?= $link_title; ?>"/>
        <link rel="self" href="<?= $link_href; ?>" title="<?= $link_title; ?>"/>
    </entry>
</feed>

<?php
exit;
// end of file
