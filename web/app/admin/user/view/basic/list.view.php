<table class="table">
  <thead>
	<tr>
	  <th>-</th>
	  <th>아이디</th>
	  <th>이메일</th>
	  <th>가입일</th>
	  <th>최근접속일</th>
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
	</tr>

<?php
	}
}
?>
  </tbody>
</table>

<?php
	mapc_file_skin_include($TPL_DATA['paging']['file'], $TPL_DATA['paging']['data']);
?>
