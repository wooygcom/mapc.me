<?php
/**
 *
 * View
 *
 * @version 0.1
 *
 */
$v['head']['extension'] = <<< EOT
    <!-- jQuery.js -->
    <script
      src="https://code.jquery.com/jquery-3.4.1.min.js"
      integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
      crossorigin="anonymous"></script>

    <!-- jQueryUI -->
    <script
      src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
      integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
      crossorigin="anonymous"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <style type="text/css">
      .modal-backdrop {
        z-index: -1;
      }
    </style>

    <!-- Handsontable.js -->
    <script src="https://cdn.jsdelivr.net/npm/handsontable@7.2.2/dist/handsontable.full.min.js"></script>

    <!-- Handsontable -->
    <link href="https://cdn.jsdelivr.net/npm/handsontable@7.2.2/dist/handsontable.full.min.css" rel="stylesheet" media="screen">
    <style type="text/css">
      #dataTable{
        width:100%;
      }
    </style>

    <!-- 주소API : B -->
    <script>
      function jusoCallBack(roadFullAddr,roadAddrPart1,addrDetail,roadAddrPart2,engAddr,jibunAddr,zipNo,admCd,rnMgtSn,bdMgtSn,detBdNmList,bdNm,bdKdcd,siNm,sggNm,emdNm,liNm,rn,udrtYn,buldMnnm,buldSlno,mtYn,lnbrMnnm,lnbrSlno,emdNo){
        document.getElementById('roadAddrPart1').value = roadAddrPart1;
        document.getElementById('addrDetail').value = addrDetail;
      }

      function goPopup(){
        // 주소검색을 수행할 팝업 페이지를 호출합니다.
        // 호출된 페이지(jusoPopup_utf8.php)에서 실제 주소검색URL(http://www.juso.go.kr/addrlink/addrLinkUrl.do)를 호출하게 됩니다.
        var pop = window.open("/mapc.me/web/mapc-public/api/juso/popup","pop","width=570,height=420, scrollbars=yes, resizable=yes"); 
        
        // 모바일 웹인 경우, 호출된 페이지(jusoPopup_utf8.php)에서 실제 주소검색URL(http://www.juso.go.kr/addrlink/addrMobileLinkUrl.do)를 호출하게 됩니다.
          //var pop = window.open("/jusoPopup_utf8.php","pop","scrollbars=yes, resizable=yes"); 
      }
    </script>
    <!-- 주소API : E -->
</script>
EOT;

// #TODO %s 를 넣기만 하면 에러가 남
// 위쪽에 ROOT_URL대신 /mapc.me/web/mapc-public/ 을 임시로 넣어놨음, 디버깅해서 아래코드가 활성화되게 해야 됨
$v['header']['extension'] = sprintf($v['header']['extension'], ROOT_URL);

$layout = 'admin-lte';
include(LAYOUT_PATH . $layout . DS . 'head.php');
include(LAYOUT_PATH . $layout . DS . 'header.php');
?>

<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form role="form">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="modalFormLabel">등록</h4>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="name">이름</label>
              <input type="text" class="form-control" id="name" placeholder="이름을 입력하세요.">
            </div>
            <div class="form-group col-md-6">
              <label for="email">아이디</label>
              <input type="email" class="form-control" id="email" placeholder="userid@emailserver">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="group">소속</label>
              <input type="text" class="form-control" id="group" placeholder="직위를 입력하세요.">
            </div>
            <div class="form-group col-md-6">
              <label for="role">직위</label>
              <input type="text" class="form-control" id="role" placeholder="직책를 입력하세요.">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="hp">휴대전화</label>
              <input type="text" class="form-control" id="hp" placeholder="010-0000-0000 형태">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="hp">휴대전화</label>
              <input type="text" class="form-control" id="hp" placeholder="010-0000-0000 형태">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="address">주소</label>
              <input type="text" class="form-control" id="roadAddrPart1" placeholder="주소">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="address">상세주소</label>
              <input type="text" class="form-control" id="addrDetail" placeholder="상세주소">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <a href="#dummy" onClick="goPopup();">주소</a>
          <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
          <button type="submit" class="btn btn-primary">저장</button>
        </div>
  
<?php
/*
    <input id ="roadAddrPart1">
    <input id ="addrDetail">
*/
?>
<?php
/*
    <input id ="roadFullAddr">
    <input id ="roadAddrPart2">
    <input id ="engAddr">
    <input id ="jibunAddr">
    <input id ="zipNo">
    <input id ="admCd">
    <input id ="rnMgtSn">
    <input id ="bdMgtSn">
    <input id ="detBdNmList">
    
    <input id ="bdNm">
    <input id ="bdKdcd">
    <input id ="siNm">
    <input id ="sggNm">
    <input id ="emdNm">
    <input id ="liNm">
    <input id ="rn">
    <input id ="udrtYn">
    <input id ="buldMnnm">
    <input id ="buldSlno">
    <input id ="mtYn">
    <input id ="lnbrMnnm">
    <input id ="lnbrSlno">
    <input id ="emdNo">
*/
?>
      </div>
    </form>
  </div>
</div>

<!-- Content : B -->
  <section class="content">

<div id="container">
  <div class="columnLayout">

    <div class="rowLayout">
      <div class="descLayout">
        <div class="pad" data-jsfiddle="dataTable">

          <p>
            <button name="new" type="button" data-toggle="modal" data-target="#modalForm">새로등록</button>
            <button name="load">불러오기</button>
            <button name="save">저장</button>
            <button name="reset">초기화</button>
            <label><input type="checkbox" name="autosave" checked="checked" autocomplete="off"> 자동저장</label>
          </p>

          <div id="dataTableConsole" class="console">"불러오기"를 누르면 서버의 정보를 가져옵니다. (현재 편집중인 내용은 초기화 됩니다.)</div>

          <div id="dataTable"></div>

          <p>
            <button name="dump" data-dump="#dataTable" title="Prints current data source to Firebug/Chrome Dev Tools">
              콘솔에서 자료 보여주기
            </button>
          </p>
        </div>
      </div>

      <div class="codeLayout">
        <div class="pad">
          <script>
            var $container = $("#dataTable");
            var $console = $("#dataTableConsole");
            var $parent = $container.parent();
            var autosaveNotification;
            $container.handsontable({
              licenseKey: 'non-commercial-and-evaluation',
              stretchH: "all",
              preventOverflow: 'horizontal',
              bindRowsWithHeaders: 'strict',
              multiColumnSorting: true,
              startRows: 8,
              startCols: 4,
              rowHeaders: true,
              colHeaders: ['소속', '이름', '등록일', '아이디', '비고'],
              columns: [
                {description:"<a href='#'>AAA</a>"},
                {},
                {},
                {},
                {}
              ],
              minSpareCols: 0,
              minSpareRows: 1,
              contextMenu: true,
              afterChange: function (change, source) {
                if (source === 'loadData') {
                  return; //don't save this change
                }
                if ($parent.find('input[name=autosave]').is(':checked')) {
                  clearTimeout(autosaveNotification);
                  $.ajax({
                    url: "<?= ROOT_URL; ?>commonAdmin/users/save",
                    dataType: "json",
                    type: "POST",
                    data: {changes: change}, //contains changed cells' data
                    success: function () {
                      $console.text('자동저장되었습니다. (' + change.length + ' 칸)');
                      autosaveNotification = setTimeout(function () {
                        $console.text('바꾸는 내용은 자동저장됩니다.');
                      }, 1000);
                    }
                  });
                }
              }
            });
            var handsontable = $container.data('handsontable');
            $parent.find('button[name=load]').click(function () {
              $.ajax({
                url: "<?= ROOT_URL; ?>commonAdmin/users/load",
                dataType: 'json',
                type: 'GET',
                success: function (res) {
                  var data = [], row;
                    console.log(res.users.length);
                    console.log("A");
                  for (var i = 0, ilen = res.users.length; i < ilen; i++) {
                    row = [];
                    row[0] = res.users[i].user_group;
                    row[1] = res.users[i].user_name;
                    row[2] = res.users[i].user_reg_date;
                    row[3] = res.users[i].user_id;
                    row[4] = res.users[i].user_etc;
                    data[res.users[i].id - 1] = row;
                  }
                  $console.text('불러오기 완료');
                  handsontable.loadData(data);
                }
              });
            }).click(); //execute immediately
            $parent.find('button[name=save]').click(function () {
              $.ajax({
                url: "<?= ROOT_URL; ?>commonAdmin/users/save",
                data: {"data": handsontable.getData()}, //returns all cells' data
                dataType: 'json',
                type: 'POST',
                success: function (res) {
                  if (res.result === 'ok') {
                    $console.text('저장되었습니다.');
                  }
                  else {
                    $console.text('저장중에 에러가 발생했습니다.');
                  }
                },
                error: function () {
                  $console.text('저장중에 에러가 발생했습니다.');
                }
              });
            });
            $parent.find('button[name=reset]').click(function () {
              $.ajax({
                url: "<?= ROOT_URL; ?>commonAdmin/users/reset",
                success: function () {
                  $parent.find('button[name=load]').click();
                },
                error: function () {
                  $console.text('초기화 실패했습니다.');
                }
              });
            });
            $parent.find('input[name=autosave]').click(function () {
              if ($(this).is(':checked')) {
                $console.text('변경내용은 자동저장됩니다');
              }
              else {
                $console.text('변경내용은 자동저장되지 않습니다.');
              }
            });
          </script>
          <script>
            $(document).ready(function() {
              jusoCallBack('roadFullAddr','roadAddrPart1','addrDetail','roadAddrPart2','engAddr','jibunAddr','zipNo','admCd','rnMgtSn','bdMgtSn','detBdNmList','bdNm','bdKdcd','siNm','sggNm','emdNm','liNm','rn','udrtYn','buldMnnm','buldSlno','mtYn','lnbrMnnm','lnbrSlno','emdNo');
            });
          </script>
        </div>
      </div>
    </div>

  </div>
</div>

  </section>
<!-- Content : E -->

<div id="example1"></div>

<?php
include(LAYOUT_PATH . $layout . DS . 'footer.php');
include(LAYOUT_PATH . $layout . DS . 'foot.php');

// this is it

/*
  function jusoCallBack(roadFullAddr,roadAddrPart1,addrDetail,roadAddrPart2,engAddr,jibunAddr,zipNo,admCd,rnMgtSn,bdMgtSn,detBdNmList,bdNm,bdKdcd,siNm,sggNm,emdNm,liNm,rn,udrtYn,buldMnnm,buldSlno,mtYn,lnbrMnnm,lnbrSlno,emdNo){
    document.getElementById('roadAddrPart1').value = roadAddrPart1;
    document.getElementById('addrDetail').value = addrDetail;
    document.getElementById('roadFullAddr').value = roadFullAddr;
    document.getElementById('roadAddrPart2').value = roadAddrPart2;
    document.getElementById('engAddr').value = engAddr;
    document.getElementById('jibunAddr').value = jibunAddr;
    document.getElementById('zipNo').value = zipNo;
    document.getElementById('admCd').value = admCd;
    document.getElementById('rnMgtSn').value = rnMgtSn;
    document.getElementById('bdMgtSn').value = bdMgtSn;
    document.getElementById('detBdNmList').value = detBdNmList;
    // 2017년 2월 제공항목 추가
    document.getElementById('bdNm').value = bdNm;
    document.getElementById('bdKdcd').value = bdKdcd;
    document.getElementById('siNm').value = siNm;
    document.getElementById('sggNm').value = sggNm;
    document.getElementById('emdNm').value = emdNm;
    document.getElementById('liNm').value = liNm;
    document.getElementById('rn').value = rn;
    document.getElementById('udrtYn').value = udrtYn;
    document.getElementById('buldMnnm').value = buldMnnm;
    document.getElementById('buldSlno').value = buldSlno;
    document.getElementById('mtYn').value = mtYn;
    document.getElementById('lnbrMnnm').value = lnbrMnnm;
    document.getElementById('lnbrSlno').value = lnbrSlno;
    // 2017년 3월 제공항목 추가
    document.getElementById('emdNo').value = emdNo;
  }
*/
