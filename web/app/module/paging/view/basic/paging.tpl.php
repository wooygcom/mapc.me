<!-- 페이징 : B -->
<div id="paging">
<?php
	if ($prev) {
		echo '<a href="'.$url.'&page='.$prev.'">이전</a>';
	} else {
		echo '이전';
	}

	foreach($range as $var) {
		// 현재페이지를 표시할 경우
		if($var == $page) {
			echo '['.$var.']';
		// 현재페이지 이외의 페이지를 표시할 경우
		} else {
			echo '[<a href="'.$url.'&page='.$var.'">'.$var.'</a>]';
		}
	}

	if ($next) {
		echo '<a href="'.$url.'&page='.$next.'">다음</a>';
	} else {
		echo '다음';
	}
?>
</div>
<!-- 페이징 : E -->
