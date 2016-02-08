<?php
if(count($VIEW['post_list']) > 0) {
	foreach($VIEW['post_list'] as $key => $var) {
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<a href="<?= $URL['mapc']['view']; ?>mapc_uid/<?= $var['post_uid']; ?>/<?= $url_search_addition; ?>/mapc_lang/<?= $var['post_lang']; ?>"><?= $var['post_title']; ?></a> / <?= $var['file_type']; ?> / <?= $var['post_write_date']; ?>
	</div>
	<div class="panel-body">
		<?=
            nl2br(mb_strimwidth(
                htmlspecialchars($var['post_content']), 0, 255,
                '... <a href="' . $URL['mapc']['view'] . 'mapc_uid/' . $var['post_uid'] . '/' . $url_search_addition . '">더보기</a>',
                $CONFIG['encode']));
        ?>
	</div>
</div>

<?php
	}

    mapc_file_skin_include($PATH['_paging'], $VIEW['_paging']);

} elseif (! empty($mapc_srch_title) ) {
?>

    <?= $mapc_srch_title; ?>에 대한 글이 없습니다.
    <br />
    글쓰기 -&gt; <a href="<?= $URL['mapc']['edit']; ?>&mapc_title=<?= $mapc_srch_title; ?>">마크다운으로 글 쓰기</a> || <a href="<?= $URL['mapc']['edit']; ?>&mapc_title=<?= $mapc_srch_title; ?>">이 제목의 파일 업로드</a>

<?php
} else {
?>

<div class="panel panel-default">
    <div class="panel-body">
        글이 없습니다.
    </div>
</div>

<?php
}
?>
