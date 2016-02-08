    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Tables
        <small>advanced tables</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">

<table class="table table-hover">
    <thead>
        <tr>
            <th>
                <?= _('제목'); ?>
            </th>
            <th>
                <?= _('글쓴날'); ?>
            </th>
        </tr>
    </thead>

<?php
if(count($VIEW['posts']) > 0) {
    foreach($VIEW['posts'] as $key => $var) {
?>

    <tbody>
        <tr>
            <td>
                <a href="<?= $URL['core']['root']; ?>admin-mapc/posts/<?= $var['post_uid']; ?>/read/<?= $url_search_addition; ?>"><?= $var['post_title']; ?></a>
            </td>
            <td>
                <?= $var['post_write_date']; ?>
            </td>
<!--
    <p class="panel-body">
        <?=
            nl2br(mb_strimwidth(
                htmlspecialchars($var['post_content']), 0, 255,
                '... <a href="' . $URL['core']['root'] . 'mapc/posts/' . $var['post_uid'] . '/read/' . $url_search_addition . '">더보기</a>',
                $CONFIG['encode']));
        ?>
    </p>
-->
        </tr>
    </tbody>

<?php
    }
?>

</table>

<?php
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

            </div>
          </div>
        </div>
      </div>
    </section>
