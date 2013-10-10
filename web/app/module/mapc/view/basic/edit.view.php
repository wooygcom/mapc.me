<section>
<form method="post" action="<?= $URL['mapc']['edit_act']; ?>" role="form" enctype="multipart/form-data">

    <div class="form-group">
        <label>
    		제목
    	</label>
    	<input type="text" name="post_title" value="<?= $arg['post_title']; ?>" class="form-control" />
    </div>

    <div class="form-group">
    	<label>
    		원문
    	</label>
    	<textarea name="post_content" class="wymeditor form-control" style="height: 150px;"></textarea>
    </div>

    <div class="form-group">

        <button type="submit" class="btn btn-primary btn-large wymupdate">확인</button>

    </div>


    <div class="form-group">
        <label>
            자원의 형태
        </label>

        <div class="checkbox-inline">
            <label>
                <input type="radio" name="data_type" value="file" class="f_data_type" /> 파일
            </label>
        </div>
        <div class="checkbox-inline">
            <label>
                <input type="radio" name="data_type" value="file_uploaded" class="f_data_type" /> 파일(서버)
            </label>
        </div>
        <div class="checkbox-inline">
            <label>
                <input type="radio" name="data_type" value="url" class="f_data_type" /> URL
            </label>
        </div>
        <div class="checkbox-inline">
            <label>
                <input type="radio" name="data_type" value="text" class="f_data_type" checked="checked" /> 텍스트
            </label>
        </div>
        <div class="checkbox-inline">
            <label>
                <input type="radio" name="data_type" value="markdown" class="f_data_type" checked="checked" /> 마크다운
            </label>
        </div>

        <!-- URL (원자료의 코드 또는 URL을 적을 때) -->
        <div id="data_type_url_awqs" style="display:none;">
			<label>
				URL
			</label>
			<input type="text" name="rdf_about" value="<?= $arg['rdf_about']; ?>" class="form-control" />
        </div>

        <!-- 새파일 (새로 업로드 할 때) -->
        <div id="data_type_file_awqs" style="display:none;">
        <!-- jquery-file-upload -->
            <input id="fileupload" type="file" name="post_file[]" multiple="multiple">
<?php
/*
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
*/
?>
       <!-- jquery-file-upload -->
        </div>

        <!-- 기존 파일 선택 -->
        <div id="data_type_file_uploaded_awqs" style="display:none;">
        </div>

        <!-- 마크다운 선택 -->
        <div id="data_type_text_awqs" style="display:none;">
        </div>

    </div>

<!-- ========== 시스템에 필요한 정보 : head ========== -->

    <div class="form-group">
	   <label>
			고유값(영문과 숫자로만)
		<?php
			// #TODO 제목입력할 때 자동으로 파일이름이 들어가도록(영문으로 변환)
		?>
		</label>
		<input type="text" name="slug" value="<?= $arg['slug']; ?>" class="form-control" />
	</div>

    <div class="form-group">
    	<label>
    		분류(메뉴)
<?php
// #TODO 분류를 불러오는 기능
?>
    	</label>
    	<input type="text" name="meta[mapc_cate]" value="<?= $meta['mapc_cate']; ?>" class="form-control" />
    </div>

    <div class="form-group">
    	<label>
    		디렉토리(물리적분류)
<?php
// #TODO 서버의 디렉토리 구성을 불러오는 기능
?>
    	</label>
    	<input type="text" name="meta[mapc_directory]" value="<?= $meta['mapc_directory']; ?>" class="form-control" />
    </div>

<!-- ========== 시스템에 필요한 정보 : tail ========== -->


<!-- ========== 메타데이타 : head ========== -->

    <div class="form-group">
    	<label>
    		주제
    	</label>
    	<input type="text" name="meta[dc_subject]" value="<?= $dc['dc_subject']; ?>" class="form-control" />
    </div>

    <div class="form-group">
    	<label>
    		요약설명(요약설명이 없을 경우, 원문의 앞부분이 들어갑니다.)
    	</label>
    	<input type="text" name="meta[dc_description]" value="<?= $dc['dc_description']; ?>" class="form-control" />
    </div>

    <div class="form-group">
    	<label>
    		형식(자원의 구현 방식)
    	</label>
    	<input type="text" name="meta[dc_format]" value="<?= $dc['dc_format']; ?>" class="form-control" />
    </div>

    <div class="form-group">
    	<label class="control-label">
    		기고자(#todo 지은이와 동일인일 경우 체크)
    	</label>
    	<input type="text" name="meta[dc_contributor]" value="<?= $dc['dc_contributor']; ?>" class="form-control" />
    </div>

    <div class="form-group">
    	<label>
    		언어
    	</label>
    	<input type="text" name="meta[dc_language]" value="<?= $dc['dc_language']; ?>" class="form-control" />
    </div>

    <div class="form-group">
    	<label>
    		유형(내용물의 성격, 장르)
    	</label>
    	<input type="text" name="meta[dc_type]" value="<?= $dc['dc_type']; ?>" class="form-control" />
    </div>

    <div class="form-group">
    	<label>
    		날짜(ISO 8601)
    	</label>
    	<input type="text" name="meta[dc_date]" value="<?= $dc['dc_date']; ?>" class="form-control" />
    </div>

    <div class="form-group">
    	<label>
    		지은이
    	</label>
    	<input type="text" name="meta[dc_creator]" value="<?= $dc['dc_creator']; ?>" class="form-control" />
    </div>

    <div class="form-group">
    	<label>
    		발행처
    	</label>
    	<input type="text" name="meta[dc_publisher]" value="<?= $dc['dc_publisher']; ?>" class="form-control" />
    </div>

    <div class="form-group">
    	<label>
    		식별자
    	</label>
    	<input type="text" name="meta[dc_identifier]" value="<?= $dc['dc_identifier']; ?>" class="form-control" />
    </div>

    <div class="form-group">
    	<label>
    		타 자원과의 관계
    	</label>
    	<input type="text" name="meta[dc_relation]" value="<?= $dc['dc_relation']; ?>" class="form-control" />
    </div>

    <div class="form-group">
    	<label>
    		출처
    	</label>
    	<input type="text" name="meta[dc_source]" value="<?= $dc['dc_source']; ?>" class="form-control" />
    </div>

    <div class="form-group">
    	<label>
    		권한
    	</label>
    	<input type="text" name="meta[dc_rights]" value="<?= $dc['dc_rights']; ?>" class="form-control" />
    </div>

    <div class="form-group">
    	<label>
    		범위
    	</label>
    	<input type="text" name="meta[dc_coverage]" value="<?= $dc['dc_coverage']; ?>" class="form-control" />
    </div>

<!-- ========== 메타데이타 : tail ========== -->

    <div class="form-group">

    	<button type="submit" class="btn btn-primary btn-large wymupdate">확인</button>

    </div>

</form>

</section>

<script type="text/javascript">

$( ".f_data_type" ).click(function() {
    var data_type = $( this ).val();
    $("#data_type_file_awqs").hide();
    $("#data_type_file_uploaded_awqs").hide();
    $("#data_type_url_awqs").hide();
    $("#data_type_text_awqs").hide();

    switch(data_type) {

        case 'file':
            $("#data_type_file_awqs").show();
            break;

        case 'file_uploaded':
            $("#data_type_file_uploaded_awqs").show();
            break;

        case 'url':
            $("#data_type_url_awqs").show();
            break;

		case 'markdown':
        case 'text':
            $("#data_type_text_awqs").show();
            break;

    }

});
</script>
