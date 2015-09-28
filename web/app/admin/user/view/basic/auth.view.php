<table class="table">
  <thead>
	<tr>
	  <th>-</th>
	  <th>권한</th>
	  <th>기타</th>
	  <th>-</th>
	</tr>
  </thead>
  <tbody>
<?php

if(is_array($post_list)) {
	foreach($post_list as $key => $var) {
?>

	<tr>
		<td>
			<input type="checkbox" value="" />
		</td>
		<td>
			<?= $var['usermeta_value']; ?>
		</td>
		<td>
			<?= $var['usermeta_desc']; ?>
		</td>
		<td>
			<a href="#dummy" class="proc_open_control_popup" data-user="<?= $var['user_uid']; ?>">관리</a>
			<div id="user-detail-pop-<?= $var['user_uid']; ?>" style="display:none;">
				<a href="<?= $URL_ADMIN['user']['root']; ?>&core_page=auth_del&user_uid=<?= $var['user_uid']; ?>">권한</a>
				<a href="<?= $URL_ADMIN['user']['root']; ?>&core_page=menu&user_uid=<?= $var['user_uid']; ?>">삭제</a>
			</div>
		</td>
	</tr>

<?php
	}
}
?>
  </tbody>
</table>

<a href="#dummy">추가</a>

<?php
	mapc_file_skin_include($TPL_DATA['paging']['file'], $TPL_DATA['paging']['data']);
?>

<script>
$(".proc_open_control_popup").click(function() {
    var user_id = $(this).data("user");
    console.log(user_id);
    $("#user-detail-pop-" + user_id).toggle();
});
</script>
