<?php
    $mapc_cate = (! empty($mapc_cate)) ? $mapc_cate : 'list';
    $selected_mapc_cate[$mapc_cate] = ' checked="checked" ';

	if(is_array($mapc_search)) {

		foreach($mapc_search as $key => $var) {
			$checked_search[$var] = ' checked="checked" ';
		}

	}
    if(! empty($mapc_srch_lang) ) {
        $checked_search['dc_language:' . $mapc_srch_lang] = ' checked="checked" ';
    }
?>

<section>
    <form method="post" action="<?= $URL['mapc']['list']; ?>" role="form" enctype="multipart/form-data" role="form" class="form-horizontal">
    <label>검색옵션:</label>
    <ul>
        <li>
            <label>
                제목
            </label>
            <div class="form-group">
                <div class="col-xs-10">
                    <input type="text" name="mapc_srch_title" value="<?= $mapc_srch_title; ?>" class="form-control input-sm" />
                </div>
            </div>
        </li>
        <li>
            <label>
                표시형태
            </label>
            <div class="form-group">
                <input type="radio" name="mapc_cate" value="list" <?= $selected_mapc_cate['list']; ?> /> <a href="<?= $URL['mapc']['list']; ?>mapc_cate/list">리스트</a>
                <input type="radio" name="mapc_cate" value="image" <?= $selected_mapc_cate['image']; ?> /> <a href="<?= $URL['mapc']['list']; ?>mapc_cate/image">앨범</a>
                <input type="radio" name="mapc_cate" value="date" <?= $selected_mapc_cate['date']; ?> /> <a href="<?= $URL['mapc']['list']; ?>mapc_cate/date">달력</a>
                <input type="radio" name="mapc_cate" value="tag" <?= $selected_mapc_cate['tag']; ?> /> <a href="<?= $URL['mapc']['list']; ?>mapc_cate/tag">꼬리표</a>
            </div>
        </li>
        <li>
            <label>
                언어
            </label>
            <div class="form-group">
<?php
echo ' <input type="radio" name="mapc_srch_lang" value="" checked="checked" /> <a href="' . $URL['mapc']['list'] . 'mapc_srch_lang/">모든언어</a> ';
if(count($so_rlt['dc_language']) > 0) {
    foreach($so_rlt['dc_language'] as $key => $var) {
        echo ' <input type="radio" name="mapc_srch_lang" value="' . $var['postmeta_value'] . '" ' . $checked_search[ 'dc_language:' . $var['postmeta_value'] ]. ' /> '
           . ' <a href="' . $URL['mapc']['list'] . 'mapc_srch_lang/' . $var['postmeta_value'] . '">' . $var['postmeta_value'] . '</a>';

    }
}
?>
            </div>
        </li>
        <li>
            <label>
                주제
            </label>
            <div class="form-group">
<?php
if(count($so_rlt['dc_subject']) > 0) {
    foreach($so_rlt['dc_subject'] as $key => $var) {
        echo ' <input type="checkbox" name="mapc_search[]" value="dc_subject:' . $var['postmeta_value'] . '" ' . $checked_search['dc_subject:' . $var['postmeta_value'] ]. ' /> '
           . ' <a href="' . $URL['mapc']['list'] . 'mapc_search_key/dc_subject:' . $var['postmeta_value'] . '">' . $var['postmeta_value'] . '</a>';

    }
}
?>
            </div>
        </li>
        <li>
            <label>
                형식/형태별
            </label>
            <div class="form-group">
<?php
if(count($so_rlt['dc_type']) > 0) {
    foreach($so_rlt['dc_type'] as $key => $var) {
        echo ' <input type="checkbox" name="mapc_search[]" value="dc_type:' . $var['postmeta_value'] . '" ' . $checked_search['dc_type:' . $var['postmeta_value'] ]. ' /> '
           . ' <a href="' . $URL['mapc']['list'] . 'mapc_search_key/dc_type:' . $var['postmeta_value'] . '">' . $var['postmeta_value'] . '</a>';

    }
}
?>
            </div>
        </li>
        <li>
            <label>
                유형별
            </label>
            <div class="form-group">
<?php
if(count($so_rlt['dc_format']) > 0) {
    foreach($so_rlt['dc_format'] as $key => $var) {
        echo ' <input type="checkbox" name="mapc_search[]" value="dc_format:' . $var['postmeta_value'] . '" ' . $checked_search['dc_format:' . $var['postmeta_value'] ]. ' /> '
           . ' <a href="' . $URL['mapc']['list'] . 'mapc_search_key/dc_format:' . $var['postmeta_value'] . '">' . $var['postmeta_value'] . '</a>';

    }
}
?>
            </div>
        </li>
        <li>
            <label>
                범위(지리적, 시대적)
            </label>
            <div class="form-group">
<?php
if(count($so_rlt['dc_coverage']) > 0) {
    foreach($so_rlt['dc_coverage'] as $key => $var) {
        echo ' <input type="checkbox" name="mapc_search[]" value="dc_coverage:' . $var['postmeta_value'] . '" ' . $checked_search['dc_coverage:' . $var['postmeta_value'] ]. ' /> '
           . ' <a href="' . $URL['mapc']['list'] . 'mapc_search_key/dc_coverage:' . $var['postmeta_value'] . '">' . $var['postmeta_value'] . '</a>';

    }
}
?>
            </div>
        </li>
        <li>
            <label>
                날짜
            </label>
            <div class="form-group">
                <div class="col-xs-5">
                    시작일 <input type="text" id="mapc_srch_from_cvaz" name="mapc_date_from" value="<?= $mapc_date_from; ?>" class="form-control input-sm col-xs-2" />
                </div>
                <div class="col-xs-5">
                    종료일 <input type="text" id="mapc_srch_to_cvaz" name="mapc_date_to" value="<?= $mapc_date_to; ?>" class="form-control input-sm col-xs-2" />
                </div>
            </div>
        </li>
    </ul>

    <button type="submit" class="btn btn-primary btn-block" />검색</button>

    </form>
</section>

<script type="text/javascript">
 $(function() {
    $( "#mapc_srch_from_cvaz" ).datepicker({
        dateFormat: "yy-mm-dd",
        changeYear: true,
        changeMonth: true,
        onClose: function( selectedDate ) {
            $( "#mapc_srch_to_cvaz" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#mapc_srch_to_cvaz" ).datepicker({
        dateFormat: "yy-mm-dd",
        changeYear: true,
        changeMonth: true,
        onClose: function( selectedDate ) {
            $( "#mapc_srch_from_cvaz" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
});
</script>
