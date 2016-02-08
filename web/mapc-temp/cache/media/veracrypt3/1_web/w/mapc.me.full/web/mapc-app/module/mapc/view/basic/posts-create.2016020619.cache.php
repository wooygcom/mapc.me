
<form method="post" action="/w/mapc.me.full/web/mapc-public/mapc/posts/create" role="form" class="dropzone" enctype="multipart/form-data">
    <input type="hidden" name="_csrf" value="f120862a7aaf83a37ddb64d85c5bfd6bc7eaaddcdbd04525ae5168ccfbf6f251" />
    <input type="hidden" name="_method" value="post" />
    <input type="hidden" name="post-uid" value="" />
    <input type="hidden" name="post-lang" value="" />
    <input type="hidden" name="meta[rdf_about]" value="" />
    <input type="hidden" name="link_to" value="/w/mapc.me.full/web/mapc-public/mapc/posts/create" />

    <div class="form-group">
        <label for="post-title-icaz">
            제목
        </label>
        <input id="post-title-icaz" name="post-title" value="" type="text" class="form-control" />
    </div>
    <div class="form-group">
        <label for="post-content-icaz">
            내용
        </label>
        <textarea id="post-content-icaz" name="post-content" class="form-control wymeditor" style="height: 300px;"></textarea>
    </div>
    <div class="form-group">
        <label for="post-icaz">
            URL
        </label>
        <input id="post-url-icaz" name="post-url" value="" type="text" class="form-control" />
    </div>
    <div class="checkbox">
        <label>
            <input id="mapc-slug-change-by-title-owqa" name="mapc_slug_change_by_title" type="checkbox"  /> 제목이 바뀌면 저장 화일명도 바꾸기
        </label>
    </div>
    <button type="submit" class="btn btn-primary btn-lg btn-block">확인</button>
</form>











    <!-- 자원형태에 따른 옵션 : H -->
    <div class="form-group">

        <!-- URL (원자료의 코드 또는 URL을 적을 때) -->
        <div id="data_type_url_awqs" style="display:none;">
            <label>
                URL
            </label>
            <input type="text" name="mapc_url" value="" class="form-control" />
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
            <p class="form-control-static"><a href="#">화일선택</a> :             <!-- -->
            </p>
        </div>

    </div>
    <!-- 자원형태에 따른 옵션 : T -->

    <div class="form-group">
        <label>
            요약설명(요약설명이 없을 경우, 원문의 앞부분이 들어갑니다.)
        </label>
        <input type="text" name="meta[dc_description][]" value="" class="form-control" />
    </div>

    <div class="form-group" id="mapc_subject">
        <label>
            주제(태그)
            <a href="#dummy" class="mapc_subject_add_btn">추가</a> ||  <a href="#dummy" class="mapc_subject_remove_btn">제거</a>
        </label>
                            <div id="mapc_subject_node_0" class="mapc_subject_node">
                        <input type="hidden" id="mapc_subject_abks_id_0" name="meta[dc_subject_id][]" value="" class="form-control" />
                        <input type="text" id="mapc_subject_abks_0" name="meta[dc_subject][]" value="" class="form-control mapc_subject_abks" />
                    </div>
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
            <input type="text" name="meta[dc_creator][]" value="" class="form-control" />
        </div>

        <div class="form-group" id="mapc_type">
            <label>
                유형
                <a href="#dummy" class="mapc_type_add_btn">추가</a> ||  <a href="#dummy" class="mapc_type_remove_btn">제거</a>
                 (내용물의 성격, 장르, <a href="http://www.nl.go.kr/dcmi/documents/dcmi-type-vocabulary/" target="_blank">더블린코어어휘</a>, <a href="http://dublincore.org/documents/dcmi-type-vocabulary/" target="_blank">DCMI Type Vocabulary</a>)
            </label>
                            <div id="mapc_type_node_0" class="mapc_type_node">
                    <input type="hidden" id="mapc_type_abks_id_0" name="meta[dc_type_id][]" value="" class="form-control" />
                    <input type="text" id="mapc_type_abks_0" name="meta[dc_type][]" value="" class="form-control mapc_type_abks" />
                </div>
                    </div>

        <div class="form-group">
            <label>
                언어(<a href="http://www.i18nguy.com/unicode/language-identifiers.html" target="_blank">RFC 3066</a>, <a href="http://www.loc.gov/standards/iso639-2/langhome.html" target="_blank">ISO 639</a>)
            </label>
            <input type="text" name="meta[dc_language][]" value="" class="form-control" />
        </div>
        <div class="checkbox">
            <input type="checkbox" name="mapc_new_post_another_lang"  /> 새 글 등록 (다른 언어의 글을 등록할 때)
        </div>

        <div class="form-group">
            <label>
                날짜(ISO 8601, 빈 칸일 경우 이 글을 쓴 날자가 입력됩니다.)
            </label>
            <input type="text" name="meta[dc_date][]" value="" class="form-control" />
        </div>

        <div class="form-group">
            <label>
                제작일
            </label>
            <input type="text" name="meta[dc_created][]" value="" class="form-control" />
        </div>

        <div class="form-group">
            <label class="control-label">
                기여자(사람, 단체, 서비스 따위)
            </label>
            <input type="text" name="meta[dc_contributor][]" value="" class="form-control" />
        </div>

        <div class="form-group">
            <label>
                발행처
            </label>
            <input type="text" name="meta[dc_publisher][]" value="" class="form-control" />
        </div>

        <div class="form-group">
            <label>
                타 자원과의 관계
            </label>
            <input type="text" name="meta[dc_relation][]" value="" class="form-control" />
        </div>

        <div class="form-group">
            <label>
                출처
            </label>
            <input type="text" name="meta[dc_source][]" value="" class="form-control" />
        </div>

        <div class="form-group">
            <label>
                권한
            </label>
            <input type="text" name="meta[dc_rights][]" value="" class="form-control" />
        </div>

        <div class="form-group">
            <label>
                범위(지명, 시대 / 좌표나 숫자기호보다는 지명이나 시대를 우선하여 사용하는 것을 추천)
            </label>
            <input type="text" name="meta[dc_coverage][]" value="" class="form-control" />
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
            <input type="text" name="meta[dc_format][]" value="" class="form-control" />
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
                <input type="radio" name="mapc_data_type" value="markdown"  class="f_data_type" /> 마크다운
            </label>
        </div>
        <div class="checkbox-inline">
            <label>
                <input type="radio" name="mapc_data_type" value="text"  class="f_data_type" /> 텍스트
            </label>
        </div>
        <div class="checkbox-inline">
            <label>
                <input type="radio" name="mapc_data_type" value="file"  class="f_data_type" /> 파일
            </label>
        </div>
        <div class="checkbox-inline">
            <label>
                <input type="radio" name="mapc_data_type" value="file_uploaded"  checked="checked"  class="f_data_type" /> 파일(서버)
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
        <input type="text" name="mapc_dir" value="" list="dir_list_abiz" class="form-control" />
        <datalist id="dir_list_abiz">
                    </datalist>
    </div>

    <div class="form-group">
       <label>
            화일이름 (특별한 경우 이외에는 빈 칸(자동인식))
        </label>
        <input type="text" id="mapc_slug_icaz" name="mapc_slug" value="" class="form-control" />
        <div class="radio">
            <input type="radio" name="mapc_make_file" value="uid"  /> UID값과 언어코드로 화일명 만들기 (텍스트폼값은 무시)
        </div>
        <div class="radio">
            <input type="radio" name="mapc_make_file" value="date"  /> 현재시간 (텍스트폼값은 무시)
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
                $.getJSON("&core_page=post_uid", {
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
                $.getJSON("&core_page=post_uid", {
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
