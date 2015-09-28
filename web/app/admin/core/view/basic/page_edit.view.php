<section>

	<form method="post" action="<?= $URL_ADMIN['admin']['page_edit_act']; ?>" role="form" class="dropzone" enctype="multipart/form-data">

	    <div class="form-group">
	        <label>
	            페이지 이름 :
	        </label>
	        <input type="text" name="site_title" value="<?= $batch_edit_uids; ?>" class="form-control" />
	    </div>

	    <div class="form-group">
	        <label>
	            내용 / URL 선택
	        </label>

            <div class="checkbox-inline">
                <label>
                    <input type="radio" name="content_type" value="url" class="form-control" /> 내용
                </label>
            </div>
            <div class="checkbox-inline">
                <label>
                    <input type="radio" name="content_type" value="url" class="form-control" /> URL
                </label>
            </div>
	    </div>

	    <div class="form-group">
	        <label>
	            페이지 URL
	        </label>
	        <input type="text" name="site_title" value="<?= $batch_edit_uids; ?>" class="form-control" />
	    </div>

	    <div class="form-group">
	        <label>
	            페이지 내용
	        </label>
	        <input type="text" name="site_title" value="<?= $batch_edit_uids; ?>" class="form-control" />
	    </div>

	    <div class="form-group">
	
	        <button type="submit" class="btn btn-primary btn-large btn-block wymupdate">확인</button>
	
	    </div>

	</form>

</section>
