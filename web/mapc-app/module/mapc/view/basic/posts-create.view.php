<?php
/*
UID, 언어코드,
제목, 내용
title, creator, subject, description, publisher, contributor, date, type, format, identifier, source, language, relation, coverage, rights
title, creator, subject, description, publisher, contributor, date, type, format, identifier, source, language, relation, coverage, rights

`post_seq`, `post_uid`, `post_lang`, `post_title`, `post_content`, `post_content_type`, `post_origin_type`, `post_origin_server`, `post_origin_url`, `post_write_date`, `post_edit_date_latest`, `post_status`, `post_user_uid`, `post_user_name`, `post_etc`

    <div class="form-group">
        <label for="[]">[]</label>
        <input type="text" class="form-control" id="[]" placeholder="[]">
    </div>
  <div class="form-group">
    <label for="exampleInputFile">File input</label>
    <input type="file" id="exampleInputFile">
    <p class="help-block">Example block-level help text here.</p>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox"> Check me out
    </label>
  </div>
*/

// `post_title`, `post_content`, `post_content_type`, `post_origin_type`, `post_origin_server`, `post_origin_url`
?>

<form method="post" action="<?= $VIEW['actionUrl']; ?>" role="form" class="dropzone" enctype="multipart/form-data">
    <input type="hidden" name="_csrf" value="<?= $_SESSION['csrf']; ?>" />
    <input type="hidden" name="_method" value="post" />
    <input type="hidden" name="link-to" value="<?= $_SERVER['REQUEST_URI']; ?>" />
    <input type="hidden" name="post-uid" value="<?= $VIEW['postInfo']['post_uid']; ?>" />
    <input type="hidden" name="post-lang" value="<?= $VIEW['postInfo']['post_lang']; ?>" />

    <div class="form-group">
        <label for="post-content-icaz">
            내용
        </label>
        <textarea id="post-content-icaz" name="post-content" class="form-control wymeditor" style="height: 300px;"><?= htmlspecialchars($VIEW['postInfo']['post_content']); ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary btn-lg btn-block"><?= _('확인'); ?></button>

    <div class="form-group">
        <label for="post-title-icaz">
            제목
        </label>
        <input id="post-title-icaz" name="post-title" value="<?= htmlspecialchars($VIEW['postInfo']['post_title']); ?>" type="text" class="form-control" />
    </div>
    <div class="checkbox">
        <label>
            <input id="mapc-slug-change-by-title-owqa" name="mapc_slug_change_by_title" type="checkbox" <?= $checked['mapc_slug_change_by_title']; ?> /> 제목이 바뀌면 저장 화일명도 바꾸기
        </label>
    </div>
    <div class="form-group">
        <label for="post-content-type-icaz">
            내용형식(text/html, text/markdown, etc...)
        </label>
        <select id="post-content-type-icaz" name="content-type" class="form-control">
            <option value="text/markdown"><?= _('마크다운'); ?></option>
        </select>
    </div>
    <div class="form-group">
        <label for="post-icaz">
            원본위치
        </label>
        <input id="post-url-icaz" name="post-url" value="<?= htmlspecialchars($VIEW['postInfo']['post_origin_url']); ?>" type="text" class="form-control" />
    </div>

    <button type="submit" class="btn btn-primary btn-lg btn-block"><?= _('확인'); ?></button>

</form>

<?php
/*
    <input type="hidden" name="meta[rdf_about]" value="<?= $VIEW['postMetaInfo']['rdf_about'][0]; ?>" />
URL
    youtube
    daum pot
    naver tvcast
화일업로드
    이미지
    동영상
    음악
    마크다운
*/
?>








<?php
// #TODO 이 부분 따로 func 화일로 만들어도 좋을듯...
if(is_array($publish_check_option)) {
    foreach($publish_check_option as $key => $var) {
        $checked[$key] = ($var) ? ' checked="checked" ' : '';
    }
}

switch($VIEW['postInfo']['post_origin_type']) {
    case 'text/markdown':
        $checked_data_type['markdown'] = ' checked="checked" ';
        break;
    case 'text/plain':
        $checked_data_type['text'] = ' checked="checked" ';
        break;
    case 'text/url':
        $checked_data_type['url'] = ' checked="checked" ';
        break;
    case 'file':
        $checked_data_type['file'] = ' checked="checked" ';
        break;
    default:
        $checked_data_type['file_uploaded'] = ' checked="checked" ';
        break;
}
?>

    <!-- 자원형태에 따른 옵션 : H -->
    <div class="form-group">

        <!-- URL (원자료의 코드 또는 URL을 적을 때) -->
        <div id="data_type_url_awqs" style="display:none;">
            <label>
                URL
            </label>
            <input type="text" name="mapc_url" value="<?= $VIEW['postMetaInfo']['rdf_about'][0]; ?>" class="form-control" />
        </div>

        <!-- 새파일 (새로 업로드 할 때) -->
        <div id="data_type_file_awqs" style="display:none;">
        <!-- jquery-file-upload -->
            <label>
                화일(로컬화일을 새로 업로드)
            </label>
            <input id="fileupload" type="file" name="post_file[]" multiple="multiple" />
       <!-- jquery-file-upload -->
        </div>

        <!-- 기존 파일 선택 -->
        <div id="data_type_file_uploaded_awqs" style="display:none;">
            <label>
                화일(서버에 이미 있는 화일선택)
            </label>
            <p class="form-control-static"><a href="#">화일선택</a> : <?= $arg['file_name_qwer']; ?>
            <!-- -->
            </p>
        </div>

    </div>
    <!-- 자원형태에 따른 옵션 : T -->

    <div class="form-group">
        <label>
            요약설명(요약설명이 없을 경우, 원문의 앞부분이 들어갑니다.)
        </label>
        <input type="text" name="meta[dc_description][]" value="<?= htmlspecialchars($VIEW['postMetaInfo']['dc_description'][0]); ?>" class="form-control" />
    </div>

    <div class="form-group" id="mapc_subject">
        <label>
            주제(태그)
            <a href="#dummy" class="mapc_subject_add_btn">추가</a> ||  <a href="#dummy" class="mapc_subject_remove_btn">제거</a>
        </label>
        <?php
            // 주제에 값이 없을 경우 빈칸을 넣어줌
            $VIEW['postMetaInfo']['dc_subject'][0] = $VIEW['postMetaInfo']['dc_subject'][0] ? $VIEW['postMetaInfo']['dc_subject'][0] : '';
            if(is_array($VIEW['postMetaInfo']['dc_subject'])) {
                foreach($VIEW['postMetaInfo']['dc_subject'] as $key => $var) {
        ?>
                    <div id="mapc_subject_node_<?= $key; ?>" class="mapc_subject_node">
                        <input type="hidden" id="mapc_subject_abks_id_<?= $key; ?>" name="meta[dc_subject_id][]" value="<?= $VIEW['postMetaInfo']['dc_subject_id'][$key]; ?>" class="form-control" />
                        <input type="text" id="mapc_subject_abks_<?= $key; ?>" name="meta[dc_subject][]" value="<?= $var; ?>" class="form-control mapc_subject_abks" />
                    </div>
        <?php
                }
            }
        ?>
    </div>

    <div class="form-group">

        <button type="submit" class="btn btn-primary btn-large btn-block wymupdate">확인</button>

    </div>


<!-- ========== 메타데이타 : head ========== -->

    <div class="form-group">
        <a href="#dummy" class="act_metadata_aiza">추가 메타데이터 보이기/숨기기</a>
    </div>

    <div id="metadata_aiza">

        <div class="form-group">
            <label>
                지은이
            </label>
            <input type="text" name="meta[dc_creator][]" value="<?= $VIEW['postMetaInfo']['dc_creator'][0]; ?>" class="form-control" />
        </div>

        <div class="form-group" id="mapc_type">
            <label>
                유형
                <a href="#dummy" class="mapc_type_add_btn">추가</a> ||  <a href="#dummy" class="mapc_type_remove_btn">제거</a>
                 (내용물의 성격, 장르, <a href="http://www.nl.go.kr/dcmi/documents/dcmi-type-vocabulary/" target="_blank">더블린코어어휘</a>, <a href="http://dublincore.org/documents/dcmi-type-vocabulary/" target="_blank">DCMI Type Vocabulary</a>)
            </label>
            <?php
                // 주제에 값이 없을 경우 빈칸을 넣어줌(foreach로 돌리기 위해서)
                $VIEW['postMetaInfo']['dc_type'][0] = $VIEW['postMetaInfo']['dc_type'][0] ? $VIEW['postMetaInfo']['dc_type'][0] : '';
                foreach($VIEW['postMetaInfo']['dc_type'] as $key => $var) {
            ?>
                <div id="mapc_type_node_<?= $key; ?>" class="mapc_type_node">
                    <input type="hidden" id="mapc_type_abks_id_<?= $key; ?>" name="meta[dc_type_id][]" value="<?= $VIEW['postMetaInfo']['dc_type_id'][$key]; ?>" class="form-control" />
                    <input type="text" id="mapc_type_abks_<?= $key; ?>" name="meta[dc_type][]" value="<?= $var; ?>" class="form-control mapc_type_abks" />
                </div>
            <?php
                }
            ?>
        </div>

        <div class="form-group">
            <label>
                언어(<a href="http://www.i18nguy.com/unicode/language-identifiers.html" target="_blank">RFC 3066</a>, <a href="http://www.loc.gov/standards/iso639-2/langhome.html" target="_blank">ISO 639</a>)
            </label>
            <input type="text" name="meta[dc_language][]" value="<?= $VIEW['postMetaInfo']['dc_language'][0]; ?>" class="form-control" />
        </div>
        <div class="checkbox">
            <input type="checkbox" name="mapc_new_post_another_lang" <?= $checked['mapc_new_post_another_lang']; ?> /> 새 글 등록 (다른 언어의 글을 등록할 때)
        </div>

        <div class="form-group">
            <label>
                날짜(ISO 8601, 빈 칸일 경우 이 글을 쓴 날자가 입력됩니다.)
            </label>
            <input type="text" name="meta[dc_date][]" value="<?= $VIEW['postMetaInfo']['dc_date'][0]; ?>" class="form-control" />
        </div>

        <div class="form-group">
            <label>
                제작일
            </label>
            <input type="text" name="meta[dc_created][]" value="<?= $VIEW['postMetaInfo']['dc_created'][0]; ?>" class="form-control" />
        </div>

        <div class="form-group">
            <label class="control-label">
                기여자(사람, 단체, 서비스 따위)
            </label>
            <input type="text" name="meta[dc_contributor][]" value="<?= $VIEW['postMetaInfo']['dc_contributor'][0]; ?>" class="form-control" />
        </div>

        <div class="form-group">
            <label>
                발행처
            </label>
            <input type="text" name="meta[dc_publisher][]" value="<?= $VIEW['postMetaInfo']['dc_publisher'][0]; ?>" class="form-control" />
        </div>

        <div class="form-group">
            <label>
                타 자원과의 관계
            </label>
            <input type="text" name="meta[dc_relation][]" value="<?= $VIEW['postMetaInfo']['dc_relation'][0]; ?>" class="form-control" />
        </div>

        <div class="form-group">
            <label>
                출처
            </label>
            <input type="text" name="meta[dc_source][]" value="<?= $VIEW['postMetaInfo']['dc_source'][0]; ?>" class="form-control" />
        </div>

        <div class="form-group">
            <label>
                권한
            </label>
            <input type="text" name="meta[dc_rights][]" value="<?= $VIEW['postMetaInfo']['dc_rights'][0]; ?>" class="form-control" />
        </div>

        <div class="form-group">
            <label>
                범위(지명, 시대 / 좌표나 숫자기호보다는 지명이나 시대를 우선하여 사용하는 것을 추천)
            </label>
            <input type="text" name="meta[dc_coverage][]" value="<?= $VIEW['postMetaInfo']['dc_coverage'][0]; ?>" class="form-control" />
        </div>

        <div class="form-group">
            <label>
                식별자(특별한 경우 이외에는 빈 칸(자동인식))
            </label>
            <input type="text" name="meta[dc_identifier][]" value="" class="form-control" />
        </div>

        <div class="form-group">
            <label>
                형식(특별한 경우 이외에는 빈 칸(자동인식), 자원의 구현 방식, text/plain, image/jpeg 따위)
            </label>
            <input type="text" name="meta[dc_format][]" value="<?= $VIEW['postMetaInfo']['dc_format'][0]; ?>" class="form-control" />
        </div>

        <div class="form-group">

            <button type="submit" class="btn btn-primary btn-large btn-block wymupdate">확인</button>

        </div>

    </div> <!-- metadata_aiza -->

<!-- ========== 메타데이타 : tail ========== -->

<!-- ========== 시스템에 필요한 정보 : head ========== -->

    <!-- 자원형태 : H -->
    <div class="form-group">

        <label>
            자원의 형태
        </label>

        <div class="checkbox-inline">
            <label>
                <input type="radio" name="mapc_data_type" value="markdown" <?= $checked_data_type['markdown']; ?> class="f_data_type" /> 마크다운
            </label>
        </div>
        <div class="checkbox-inline">
            <label>
                <input type="radio" name="mapc_data_type" value="text" <?= $checked_data_type['text']; ?> class="f_data_type" /> 텍스트
            </label>
        </div>
        <div class="checkbox-inline">
            <label>
                <input type="radio" name="mapc_data_type" value="file" <?= $checked_data_type['file']; ?> class="f_data_type" /> 파일
            </label>
        </div>
        <div class="checkbox-inline">
            <label>
                <input type="radio" name="mapc_data_type" value="file_uploaded" <?= $checked_data_type['file_uploaded']; ?> class="f_data_type" /> 파일(서버)
            </label>
        </div>
        <div class="checkbox-inline">
            <label>
                <input type="radio" name="mapc_data_type" value="url" class="f_data_type" /> URL
            </label>
        </div>

    </div>
    <!-- 자원형태 : T -->

    <div class="form-group">
        <label>
            디렉토리(물리적분류)
        </label>
        <input type="text" name="mapc_dir" value="<?= $VIEW['postMetaInfo']['mapc_dir'][0]; ?>" list="dir_list_abiz" class="form-control" />
        <datalist id="dir_list_abiz">
            <?php
                if(is_array($server_list)) {
                    foreach($server_list as $var) {
            ?>
                        <option value="<?= $var; ?>"><?= $var; ?></option>
            <?php
                    }
                }
            ?>
        </datalist>
    </div>

    <div class="form-group">
       <label>
            화일이름 (특별한 경우 이외에는 빈 칸(자동인식))
        </label>
        <input type="text" id="mapc_slug_icaz" name="mapc_slug" value="<?= htmlspecialchars($VIEW['postMetaInfo']['slug'][0]); ?>" class="form-control" />
        <div class="radio">
            <input type="radio" name="mapc_make_file" value="uid" <?= $checked['mapc_make_file__uid']; ?> /> UID값과 언어코드로 화일명 만들기 (텍스트폼값은 무시)
        </div>
        <div class="radio">
            <input type="radio" name="mapc_make_file" value="date" <?= $checked['mapc_make_file__date']; ?> /> 현재시간 (텍스트폼값은 무시)
        </div>
    </div>

    <div class="form-group">

        <button type="submit" class="btn btn-primary btn-large btn-block wymupdate">확인</button>

    </div>

<!-- ========== 시스템에 필요한 정보 : tail ========== -->

</form>

</section>


<script type="text/javascript">

// slug값에 제목을 넣고 빈칸이 있을 경우 빈칸 대신 밑줄로 치환
$("#f-data-title-icaz").change(function() {
    if( $('#mapc-slug-change-by-title-owqa').is(':checked') ) {
        var el = $('#mapc_slug_icaz');
        el.val($("#f-data-title-icaz").val());
        el.val(el.val().replace(/\s/ig, "-"));
    }
});

</script>

<script type="text/javascript">
// 처음에는 추가 메타데이터는 숨김
$("#metadata_aiza").hide();

// init_mapc_form 1. select 되어있는 데이터타입을 가져와서
var selectVal = $('input[name=mapc_data_type]:checked').val();
var init_mapc_form = function(data_type) {

    $("#data_type_text_awqs").hide();
    $("#data_type_file_awqs").hide();
    $("#data_type_file_uploaded_awqs").hide();
    $("#data_type_url_awqs").hide();

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

}

// init_mapc_form 2. 해당 데이터타입에 맞게 화면을 초기화
init_mapc_form(selectVal);

// 주제 자동완성(입력값과 비슷한 제목의 다른 제목의 글들을 자동으로 불러오기)

// 화일 타입을 변경할 때는 그에 필요한 필드 추가로 표시(데이터타입을 url을 선택할 경우 url 입력창을 표시하는 따위의 프로세스)
$( ".f_data_type" ).click(function() {
    var data_type = $( this ).val();
    init_mapc_form(data_type);
});

// slug값에 제목을 넣고 빈칸이 있을 경우 빈칸 대신 밑줄로 치환
$("#f-data-title-icaz").change(function() {
    if( $('#mapc-slug-change-by-title-owqa').is(':checked') ) {
        var el = $('#mapc_slug_icaz');
        el.val($("#f-data-title-icaz").val());
        el.val(el.val().replace(/\s/ig, "-"));
    }
});

// 추가메타데이터 보이기/숨기기
$(".act_metadata_aiza").click(function() {
    $("#metadata_aiza").toggle();
});
</script>

<script type="text/javascript">
// 주제(dc_subject)필드 자동완성
$(function() {
    function split( val ) {
        return val.split( /,\s*/ );
    }
    function extractLast( term ) {
        return split( term ).pop();
    }

    $('body').on("keydown", ".mapc_subject_abks", function() {
        $(this).autocomplete({
            source: function( request, response ) {
                $.getJSON("<?= $URL['mapc']['root']; ?>&core_page=post_uid", {
                    mapc_search_key: extractLast( request.term )
                }, response);
            },
            search: function() {
                var term = extractLast( this.value );
                if( term.length < 2) {
                    return false;
                }
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },
            select: function(event,ui) {
                var NowCntNodes = eval($(this).attr('id').replace("mapc_subject_abks_", ""));

                $( "#mapc_subject_abks_id_" + NowCntNodes ).val( ui.item.id );
                $( "#mapc_subject_abks_" + NowCntNodes ).val( ui.item.value );

                return false;
            }
        })
        .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li>" )
            .append( "<a><strong>" + item.label + "</strong><br />" + item.desc + "</a>" )
            .appendTo( ul );
        };

    });
    
});

// Subject 필드 유동생성
$('.mapc_subject_add_btn').click(function() {
    var NowCntNodes = eval($(".mapc_subject_node:last").attr('id').replace("mapc_subject_node_", ""));
    if (NowCntNodes < 1) { NowCntNodes = 0; }
    var AddCntNodes = NowCntNodes + 1;

    $('#mapc_subject').append('<div id="mapc_subject_node_' + AddCntNodes + '" class="mapc_subject_node"></div>');
    $('#mapc_subject_node_' + AddCntNodes).append('<input type="hidden" id="mapc_subject_abks_id_' + AddCntNodes + '" name="meta[dc_subject_id][]" value="" class="form-control" />');
    $('#mapc_subject_node_' + AddCntNodes).append('<input type="text" id="mapc_subject_abks_' + AddCntNodes + '" name="meta[dc_subject][]" value="" class="form-control mapc_subject_abks" />');
});

$('.mapc_subject_remove_btn').click(function() {
    var NowCntNodes = eval($(".mapc_subject_node:last").attr('id').replace("mapc_subject_node_", ""));
    // 필드가 두개 이상 있을 경우에만 제거
    if (NowCntNodes >= 1) {
        $('.mapc_subject_node:last').remove();
    } else {
        return false;
    }
});
</script>

<script type="text/javascript">
// 유형(dc_type)필드 자동완성
$(function() {
    function split( val ) {
        return val.split( /,\s*/ );
    }
    function extractLast( term ) {
        return split( term ).pop();
    }

    $('body').on("keydown", ".mapc_type_abks", function() {
        $(this).autocomplete({
            source: function( request, response ) {
                $.getJSON("<?= $URL['mapc']['root']; ?>&core_page=post_uid", {
                    mapc_search_key: extractLast( request.term )
                }, response);
            },
            search: function() {
                var term = extractLast( this.value );
                if( term.length < 2) {
                    return false;
                }
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },
            select: function(event,ui) {
                var NowCntNodes = eval($(this).attr('id').replace("mapc_type_abks_", ""));

                $( "#mapc_type_abks_id_" + NowCntNodes ).val( ui.item.id );
                $( "#mapc_type_abks_" + NowCntNodes ).val( ui.item.value );

                return false;
            }
        })
        .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li>" )
            .append( "<a><strong>" + item.label + "</strong><br />" + item.desc + "</a>" )
            .appendTo( ul );
        };

    });
    
});

// Type 필드 유동생성
$('.mapc_type_add_btn').click(function() {
    var NowCntNodes = eval($(".mapc_type_node:last").attr('id').replace("mapc_type_node_", ""));
    if (NowCntNodes < 1) { NowCntNodes = 0; }
    var AddCntNodes = NowCntNodes + 1;

    $('#mapc_type').append('<div id="mapc_type_node_' + AddCntNodes + '" class="mapc_type_node"></div>');
    $('#mapc_type_node_' + AddCntNodes).append('<input type="hidden" id="mapc_type_abks_id_' + AddCntNodes + '" name="meta[dc_type_id][]" value="" class="form-control" />');
    $('#mapc_type_node_' + AddCntNodes).append('<input type="text" id="mapc_type_abks_' + AddCntNodes + '" name="meta[dc_type][]" value="" class="form-control mapc_type_abks" />');
});

$('.mapc_type_remove_btn').click(function() {
    var NowCntNodes = eval($(".mapc_type_node:last").attr('id').replace("mapc_type_node_", ""));
    // 필드가 두개 이상 있을 경우에만 제거
    if (NowCntNodes >= 1) {
        $('.mapc_type_node:last').remove();
    } else {
        return false;
    }
});
</script>
