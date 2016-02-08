<!-- 페이징 : B -->

<style type="text/css">
    .pagination {
        margin-top: 0px;
    }
</style>

<ul class="pagination centered">
<?php

	if ($VIEW['prev']) {
		echo '<li><a href="'.$VIEW['url'].'&' . $VIEW['pageKey'] . '=' . $VIEW['prev'] . '">&laquo;</a></li>';
	} else {
		echo '<li><a href="#dummy">&laquo;</a></li>';
	}

	foreach($VIEW['range'] as $var) {
		// 현재페이지를 표시할 경우
		if($var == $VIEW['page']) {
			echo '<li><a href="#dummy"><strong>'.$var.'</strong></a></li>';
		// 현재페이지 이외의 페이지를 표시할 경우
		} else {
			echo '<li><a href="'.$VIEW['url'].'&' . $VIEW['pageKey'] . '=' . $var . '">' . $var . '</a></li>';
		}
	}

	if ($VIEW['next']) {
		echo '<li><a href="'.$VIEW['url'].'&' . $VIEW['pageKey'] . '=' . $VIEW['next'] . '">&raquo;</a></li>';
	} else {
		echo '<li><a href="#dummy">&raquo;</a></li>';
	}
?>

</ul> <!--ul class="paging"-->

<!-- 페이징 : E -->
