<table class="table">
  <thead>
	<tr>
	  <th>-</th>
	  <th>그룹이름</th>
	  <th>설명</th>
	  <th>기타</th>
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
			<a href="<?= $URL_ADMIN['user']['root']; ?>&core_page=group_edit&user_uid="><?= $var['user_id']; ?></a>
		</td>
		<td>
			<?= $var['user_email'];  ?>
		</td>
		<td>
			<a href="#">관리</a>
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
