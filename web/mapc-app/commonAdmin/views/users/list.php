<!doctype html>
<html>
<head>
  <meta charset='utf-8'>
  <title>PHP example - Handsontable</title>

  <!--
  Loading Handsontable (full distribution that includes all dependencies apart from jQuery)
  -->
  <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script data-jsfiddle="common" src="https://cdnjs.cloudflare.com/ajax/libs/handsontable/7.1.1/handsontable.full.js"></script>
  <link data-jsfiddle="common" rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/handsontable/7.1.1/handsontable.full.css">

  <!--
  Loading demo dependencies. They are used here only to enhance the examples on this page
  -->
  <link data-jsfiddle="common" rel="stylesheet" media="screen" href="css/samples.css">
  <script src="js/samples.js"></script>
  <script src="js/highlight/highlight.pack.js"></script>
  <link rel="stylesheet" media="screen" href="js/highlight/styles/github.css">

  <!--
  Facebook open graph. Don't copy this to your project :)
  -->
  <meta property="og:title" content="PHP example - Handsontable">
  <meta property="og:description"
        content="This page loads and saves data on server. In this example, client side uses $.ajax. Server side uses PHP with PDO (SQLite)">
  <meta property="og:url" content="http://handsontable.com/demo/php.html">
  <meta property="og:image" content="http://handsontable.com/demo/image/og-image.png">
  <meta property="og:image:type" content="image/png">
  <meta property="og:image:width" content="409">
  <meta property="og:image:height" content="164">
  <link rel="canonical" href="http://handsontable.com/demo/php.html">

  <!--
  Google Analytics for GitHub Page. Don't copy this to your project :)
  -->
  <script src="js/ga.js"></script>
</head>

<body>
<a href="http://github.com/warpech/jquery-handsontable" class="forkMeOnGitHub">Fork me on GitHub</a>

<div id="container">
  <div class="columnLayout">

    <div class="rowLayout">
      <div class="descLayout">
        <div class="pad">
          <h1><a href="../index.html">Handsontable</a></h1>

          <div class="tagline">a minimalistic Excel-like <span class="nobreak">data grid</span> editor
            for HTML, JavaScript &amp; jQuery
          </div>
        </div>
      </div>
    </div>

    <div class="rowLayout">
      <div class="descLayout">
        <div class="pad" data-jsfiddle="example1">
          <h2>PHP example</h2>

          <p>This page loads and saves data on server. In this example, client side uses <b>$.ajax</b>. Server side uses
            <b>PHP with PDO (SQLite)</b>.</p>

          <p>Please note. This page and the PHP scripts are a work in progress. They are not yet configured on GitHub.
            Please run it on your own localhost.</p>

          <p>
            <button name="load">Load</button>
            <button name="save">Save</button>
            <button name="reset">Reset</button>
            <label><input type="checkbox" name="autosave" checked="checked" autocomplete="off"> Autosave</label>
          </p>

          <div id="exampleConsole" class="console">Click "Load" to load data from server</div>

          <div id="example1"></div>

          <p>
            <button name="dump" data-dump="#example1" title="Prints current data source to Firebug/Chrome Dev Tools">
              Dump data to console
            </button>
          </p>
        </div>
      </div>

      <div class="codeLayout">
        <div class="pad">
          <script>
            var $container = $("#example1");
            var $console = $("#exampleConsole");
            var $parent = $container.parent();
            var autosaveNotification;
            $container.handsontable({
              startRows: 8,
              startCols: 3,
              rowHeaders: true,
              colHeaders: ['Manufacturer', 'Year', 'Price'],
              columns: [
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
                    url: "php/save.php",
                    dataType: "json",
                    type: "POST",
                    data: {changes: change}, //contains changed cells' data
                    success: function () {
                      $console.text('Autosaved (' + change.length + ' cell' + (change.length > 1 ? 's' : '') + ')');
                      autosaveNotification = setTimeout(function () {
                        $console.text('Changes will be autosaved');
                      }, 1000);
                    }
                  });
                }
              }
            });
            var handsontable = $container.data('handsontable');
            $parent.find('button[name=load]').click(function () {
              $.ajax({
                url: "php/load.php",
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
                  $console.text('Data loaded');
                  handsontable.loadData(data);
                }
              });
            }).click(); //execute immediately
            $parent.find('button[name=save]').click(function () {
              $.ajax({
                url: "php/save.php",
                data: {"data": handsontable.getData()}, //returns all cells' data
                dataType: 'json',
                type: 'POST',
                success: function (res) {
                  if (res.result === 'ok') {
                    $console.text('Data saved');
                  }
                  else {
                    $console.text('Save error');
                  }
                },
                error: function () {
                  $console.text('Save error');
                }
              });
            });
            $parent.find('button[name=reset]').click(function () {
              $.ajax({
                url: "php/reset.php",
                success: function () {
                  $parent.find('button[name=load]').click();
                },
                error: function () {
                  $console.text('Data reset failed');
                }
              });
            });
            $parent.find('input[name=autosave]').click(function () {
              if ($(this).is(':checked')) {
                $console.text('Changes will be autosaved');
              }
              else {
                $console.text('Changes will not be autosaved');
              }
            });
          </script>
        </div>
      </div>
    </div>

    <div class="rowLayout">
      <div class="descLayout noMargin">
        <div class="pad"><p>For more examples, head back to the <a href="../index.html">main page</a>.</p>

          <p class="small">Handsontable &copy; 2012 Marcin Warpechowski and contributors.<br> Code and documentation
            licensed under the The MIT License.</p>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>

<?php
exit;
?>

<?php
/**
 *
 * View
 *
 * @version 0.1
 *
 */
$v['head']['extension'] = <<< EOT
    <!-- Handsontable -->
    <link href="https://cdn.jsdelivr.net/npm/handsontable@7.2.2/dist/handsontable.full.min.css" rel="stylesheet" media="screen">
EOT;
$v['footer']['extension'] = <<< EOT
    <!-- Handsontable -->
    <script src="https://cdn.jsdelivr.net/npm/handsontable@7.2.2/dist/handsontable.full.min.js"></script>
    <script>
        var data = [
          ['', 'Ford', 'Tesla', 'Toyota', 'Honda'],
          ['2017', 10, 11, 12, 13],
          ['2018', 20, 11, 14, 13],
          ['2019', 30, 15, 12, 13]
        ];

        var container = document.getElementById('userList');
        var hot = new Handsontable(container, {
          data: data,
          rowHeaders: true,
          colHeaders: true,
          filters: true,
          dropdownMenu: true
        });
    </script>
EOT;

$layout = 'admin-lte';
include(LAYOUT_PATH . $layout . DS . 'head.php');
include(LAYOUT_PATH . $layout . DS . 'header.php');
?>

<!-- Content : B -->
  <section class="content">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">회원관리 <small><a href="<?= $CONFIG['url']['admin']['user_regist']; ?>">등록</a></small></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="userList">
                </div>
              <table id="myTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>이름</th>
                  <th>소속</th>
                  <th>구분</th>
                  <th>아이디</th>
                  <th>비고</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>홍길동</td>
                  <td>소속123
                  </td>
                  <td>직위</td>
                  <td>아이디</td>
                  <td>비고</td>
                </tr>
                <tr>
                  <td>김구</td>
                  <td>나
                  </td>
                  <td>직위</td>
                  <td>아이디</td>
                  <td>비고</td>
                </tr>
                <tr>
                  <td>윤봉길</td>
                  <td>다
                  </td>
                  <td>직위</td>
                  <td>아이디</td>
                  <td>비고</td>
                </tr>
                <tr>
                  <td>안중근</td>
                  <td>라
                  </td>
                  <td>직위</td>
                  <td>아이디</td>
                  <td>비고</td>
                </tr>
                <tr>
                  <td>유관순</td>
                  <td>마
                  </td>
                  <td>직위</td>
                  <td>아이디</td>
                  <td>비고</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                  <th>이름</th>
                  <th>소속</th>
                  <th>직위</th>
                  <th>아이디</th>
                  <th>비고</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
  </section>
<!-- Content : E -->


<?php
include(LAYOUT_PATH . $layout . DS . 'footer.php');
include(LAYOUT_PATH . $layout . DS . 'foot.php');

// this is it
