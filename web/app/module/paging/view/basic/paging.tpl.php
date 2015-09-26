<!-- 페이징 : B -->
<style type="text/css">
    .pagination {
        margin-top: 0px;
    }
</style>

<ul class="pagination centered">
<?php

	if ($prev) {
		echo '<li><a href="'.$url.'&' . $page_key . '='.$prev.'">&laquo;</a></li>';
	} else {
		echo '<li><a href="#dummy">&laquo;</a></li>';
	}

	foreach($range as $var) {
		// 현재페이지를 표시할 경우
		if($var == $page) {
			echo '<li><a href="#dummy"><strong>'.$var.'</strong></a></li>';
		// 현재페이지 이외의 페이지를 표시할 경우
		} else {
			echo '<li><a href="'.$url.'&' . $page_key . '='.$var.'">'.$var.'</a></li>';
		}
	}

	if ($next) {
		echo '<li><a href="'.$url.'&' . $page_key . '='.$next.'">&raquo;</a></li>';
	} else {
		echo '<li><a href="#dummy">&raquo;</a></li>';
	}
?>

</ul> <!--ul class="paging"-->

<!-- 페이징 : E -->
