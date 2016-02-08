<section>

	<form method="post" action="<?= $URL_ADMIN['admin']['site_detail_act']; ?>" role="form" class="dropzone" enctype="multipart/form-data">

	    <div class="form-group">
	        <label>
	            모듈ID :
	        </label>
	        <input type="text" name="site_title" value="<?= $batch_edit_uids; ?>" class="form-control" />
	    </div>

	    <div class="form-group">
	        <label>
	            모듈이름 :
	        </label>
	        <input type="text" name="site_title" value="<?= $batch_edit_uids; ?>" class="form-control" />
	    </div>

	    <div class="form-group">
	        <label>
				버전 :
	        </label>
	        <input type="text" name="admin_email" value="<?= $batch_edit_uids; ?>" class="form-control" />
	    </div>

	    <div class="form-group">
	        <label>
				상위모듈 :
	        </label>
	        <input type="text" name="encrypt_key" value="<?= $batch_edit_uids; ?>" class="form-control" />
	    </div>

	    <div class="form-group">
	
	        <button type="submit" class="btn btn-primary btn-large btn-block wymupdate">확인</button>
	
	    </div>

	</form>

</section>
