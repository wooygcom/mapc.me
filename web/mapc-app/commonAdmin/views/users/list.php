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
    <!-- Handsontable.js -->
    <script src="https://cdn.jsdelivr.net/npm/handsontable@7.2.2/dist/handsontable.full.min.js"></script>

    <!-- Handsontable -->
    <link href="https://cdn.jsdelivr.net/npm/handsontable@7.2.2/dist/handsontable.full.min.css" rel="stylesheet" media="screen">
    <style type="text/css">
      #dataTable{
        width:100%;
      }
    </style>
EOT;
$v['footer']['extension'] = <<< EOT
EOT;

$layout = 'admin-lte';
include(LAYOUT_PATH . $layout . DS . 'head.php');
include(LAYOUT_PATH . $layout . DS . 'header.php');
?>

<!-- Content : B -->
  <section class="content">

<div id="container">
  <div class="columnLayout">

    <div class="rowLayout">
      <div class="descLayout">
        <div class="pad" data-jsfiddle="dataTable">

          <p>
            <button name="load">불러오기</button>
            <button name="save">저장</button>
            <button name="reset">초기화</button>
            <label><input type="checkbox" name="autosave" checked="checked" autocomplete="off"> 자동저장</label>
          </p>

          <div id="dataTableConsole" class="console">"불러오기"를 누르면 서버의 정보를 가져옵니다. (현재 편집중인 내용은 초기화 됩니다.)</div>

          <div id="dataTable"></div>

          <p>
            <button name="dump" data-dump="#dataTable" title="Prints current data source to Firebug/Chrome Dev Tools">
              Dump data to console
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
              colHeaders: ['이름', '상위그룹', '아이디', '아이디2'],
              columns: [
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
                    url: "<?= ROOT_URL; ?>php/save.php",
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
                url: "<?= ROOT_URL; ?>php/load.php",
                dataType: 'json',
                type: 'GET',
                success: function (res) {
                  var data = [], row;
                  for (var i = 0, ilen = res.cars.length; i < ilen; i++) {
                    row = [];
                    row[0] = res.cars[i].manufacturer;
                    row[1] = res.cars[i].year;
                    row[2] = res.cars[i].price;
                    data[res.cars[i].id - 1] = row;
                  }
                  $console.text('불러오기 완료');
                  handsontable.loadData(data);
                }
              });
            }).click(); //execute immediately
            $parent.find('button[name=save]').click(function () {
              $.ajax({
                url: "<?= ROOT_URL; ?>php/save.php",
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
                url: "<?= ROOT_URL; ?>php/reset.php",
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
        </div>
      </div>
    </div>

  </div>
</div>

  </section>
<!-- Content : E -->


<?php
include(LAYOUT_PATH . $layout . DS . 'footer.php');
include(LAYOUT_PATH . $layout . DS . 'foot.php');

// this is it
