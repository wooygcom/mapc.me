<section>
<form method="post" action="<?= $arg['dc_edit_run_url']; ?>" role="form" enctype="multipart/form-data">

    <div class="form-group">
        <label>
    		제목
    	</label>
    	<input type="text" name="post_title" value="<?= $dc['post_title']; ?>" class="form-control" />
    </div>

    <div class="form-group">
    	<label>
    		원문
    	</label>
    	<textarea name="post_content" class="wymeditor form-control"></textarea>
    </div>

    <div class="form-group">

        <button type="submit" class="btn btn-primary btn-large wymupdate">확인</button>

    </div>


    <div class="form-group">
        <label>
            자원의 위치(원문이 없을 경우 필요)
        </label>
    </div>

    <div class="form-group">
        <div class="checkbox-inline">
            <label>
                <input type="radio" name="data_type" value="content_to_text" checked="checked" /> 원문을 텍스트 파일로
            </label>
        </div>
        <div class="checkbox-inline">
            <label>
                <input type="radio" name="data_type" value="file" /> 파일 올리기
            </label>
        </div>
        <div class="checkbox-inline">
            <label>
                <input type="radio" name="data_type" value="file_uploaded" /> 이미 올린 파일 선택
            </label>
        </div>
        <div class="checkbox-inline">
            <label>
                <input type="radio" name="data_type" value="url" /> URL
            </label>
        </div>

        <!-- 일반텍스트 (원자료의 코드 또는 URL을 적을 때) -->
        <input type="text" name="rdf_about" value="<?= $dc['rdf_about']; ?>" class="form-control" />
        <!-- 화일(업로드 할 때) -->
        <!-- jquery-file-upload -->
        <input id="fileupload" type="file" name="post_file[]" multiple="multiple">
        <script src="<?= RES_PATH; ?>jquery-file-upload/vendor/jquery.ui.widget.js"></script>
        <script src="<?= RES_PATH; ?>jquery-file-upload/jquery.iframe-transport.js"></script>
        <script src="<?= RES_PATH; ?>jquery-file-upload/jquery.fileupload.js"></script>
        <script>
        $(function () {
            $('#fileupload').fileupload({
                dataType: 'json',
                done: function (e, data) {
                    $.each(data.result.files, function (index, file) {
                        $('<p />').text(file.name).appendTo(document.body);
                    });
                }
            });
        });
        </script>
        <!-- jquery-file-upload -->
    </div>

    <div class="form-group">
    	<label>
    		주제
    	</label>
    	<input type="text" name="dc[subject]" value="<?= $dc['dc_subject']; ?>" class="form-control" />
    </div>

    <div class="form-group">
    	<label>
    		요약설명(요약설명이 없을 경우, 원문의 앞부분이 들어갑니다.)
    	</label>
    	<input type="text" name="dc[description]" value="<?= $dc['dc_description']; ?>" class="form-control" />
    </div>

    <div class="form-group">
    	<label>
    		형식(자원의 구현 방식)
    	</label>
    	<input type="text" name="dc[format]" value="<?= $dc['dc_format']; ?>" class="form-control" />
    </div>

    <div class="form-group">
    	<label class="control-label">
    		기고자(#todo 지은이와 동일인일 경우 체크)
    	</label>
    	<input type="text" name="dc[contributor]" value="<?= $dc['dc_contributor']; ?>" class="form-control" />
    </div>

    <div class="form-group">
    	<label>
    		언어
    	</label>
    	<input type="text" name="dc[language]" value="<?= $dc['dc_language']; ?>" class="form-control" />
    </div>

    <div class="form-group">
    	<label>
    		유형(내용물의 성격, 장르)
    	</label>
    	<input type="text" name="dc[type]" value="<?= $dc['dc_type']; ?>" class="form-control" />
    </div>

    <div class="form-group">
    	<label>
    		날짜(ISO 8601)
    	</label>
    	<input type="text" name="dc[date]" value="<?= $dc['dc_date']; ?>" class="form-control" />
    </div>

    <div class="form-group">
    	<label>
    		지은이
    	</label>
    	<input type="text" name="dc[creator]" value="<?= $dc['dc_creator']; ?>" class="form-control" />
    </div>

    <div class="form-group">
    	<label>
    		발행처
    	</label>
    	<input type="text" name="dc[publisher]" value="<?= $dc['dc_publisher']; ?>" class="form-control" />
    </div>

    <div class="form-group">
    	<label>
    		식별자
    	</label>
    	<input type="text" name="dc[identifier]" value="<?= $dc['dc_identifier']; ?>" class="form-control" />
    </div>

    <div class="form-group">
    	<label>
    		타 자원과의 관계
    	</label>
    	<input type="text" name="dc[relation]" value="<?= $dc['dc_relation']; ?>" class="form-control" />
    </div>

    <div class="form-group">
    	<label>
    		출처
    	</label>
    	<input type="text" name="dc[source]" value="<?= $dc['dc_source']; ?>" class="form-control" />
    </div>

    <div class="form-group">
    	<label>
    		권한
    	</label>
    	<input type="text" name="dc[rights]" value="<?= $dc['dc_rights']; ?>" class="form-control" />
    </div>

    <div class="form-group">
    	<label>
    		범위
    	</label>
    	<input type="text" name="dc[coverage]" value="<?= $dc['dc_coverage']; ?>" class="form-control" />
    </div>


    <div class="form-group">

    	<button type="submit" class="btn btn-primary btn-large wymupdate">확인</button>

    </div>

</form>

</section>
