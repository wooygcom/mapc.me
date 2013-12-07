<!-- 페이징 : B -->
<style type="text/css">
	pagination {
		padding: 1200px 0px 0px 0px;
	}
</style>

<ul class="pagination centered">
<?php

	if ($prev) {
		echo '<li><a href="'.$url.'&mapc_page='.$prev.'">&laquo;</a></li>';
	} else {
		echo '<li><a href="#">&laquo;</a></li>';
	}

	foreach($range as $var) {
		// 현재페이지를 표시할 경우
		if($var == $page) {
			echo '<li><a href="#"><strong>'.$var.'</strong></a></li>';
		// 현재페이지 이외의 페이지를 표시할 경우
		} else {
			// #TODO 변수명도 mapc_page 뿐만 아니라 다른 변수명도 받을 수 있게...
			echo '<li><a href="'.$url.'&mapc_page='.$var.'">'.$var.'</a></li>';
		}
	}

	if ($next) {
		echo '<li><a href="'.$url.'&mapc_page='.$next.'">&raquo;</a></li>';
	} else {
		echo '<li><a href="#">&raquo;</a></li>';
	}
?>

</ul> <!--ul class="paging"-->

<!-- 페이징 : E -->
