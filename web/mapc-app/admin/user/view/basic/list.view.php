<table class="table">
  <thead>
	<tr>
	  <th>-</th>
	  <th>아이디</th>
	  <th>이메일</th>
	  <th>가입일</th>
	  <th>최근접속일</th>
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
			<a href="<?= $URL['mapc']['view']; ?>&mapc_uid=<?= $var['user_id']; ?>"><?= $var['user_id']; ?></a>
		</td>
		<td>
			<?= $var['user_email'];  ?>
		</td>
		<td>
			<?= $var['user_sign_up_date'];  ?>
		</td>
		<td>
			<?= $var['user_sign_in_date_latest'];  ?>
		</td>
		<td>
			<a href="#dummy" class="proc_open_control_popup" data-user="<?= $var['user_uid']; ?>">관리</a>
			<div id="user-detail-pop-<?= $var['user_uid']; ?>" style="display:none;">
				<a href="<?= $URL_ADMIN['user']['root']; ?>&core_page=group&user_uid=<?= $var['user_uid']; ?>">그룹</a>
				<a href="<?= $URL_ADMIN['user']['root']; ?>&core_page=auth&user_uid=<?= $var['user_uid']; ?>">권한</a>
				<a href="<?= $URL_ADMIN['user']['root']; ?>&core_page=menu&user_uid=<?= $var['user_uid']; ?>">메뉴</a>
			</div>
		</td>
	</tr>

<?php
	}
}
?>
  </tbody>
</table>

<?php
	mapc_file_skin_include($VIEW['_paging']);
?>

<script>
$(".proc_open_control_popup").click(function() {
    var user_id = $(this).data("user");
    console.log(user_id);
    $("#user-detail-pop-" + user_id).toggle();
});
</script>
