<?php
if(count($VIEW['posts']) > 0) {
	foreach($VIEW['posts'] as $key => $var) {
?>

<article class="panel panel-default">
	<header class="panel-heading">
		<h1><a href="<?= $URL['core']['root']; ?>mapc/posts/<?= $var['post_uid']; ?>/read/<?= $url_search_addition; ?>"><?= $var['post_title']; ?></a></h1>
        <p><?= $var['post_write_date']; ?></p>
    </header>
    <p class="panel-body">
		<?=
            nl2br(mb_strimwidth(
                htmlspecialchars($var['post_content']), 0, 255,
                '... <a href="' . $URL['core']['root'] . 'mapc/posts/' . $var['post_uid'] . '/read/' . $url_search_addition . '">더보기</a>',
                $CONFIG['encode']));
        ?>
    </p>
</article>

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
