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
  <script>
  $( function() {
    var dialog, form,
 
      // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
      emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
      name = $( "#name" ),
      email = $( "#email" ),
      password = $( "#password" ),
      allFields = $( [] ).add( name ).add( email ).add( password ),
      tips = $( ".validateTips" );
 
    function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }
 
    function checkLength( o, n, min, max ) {
      if ( o.val().length > max || o.val().length < min ) {
        o.addClass( "ui-state-error" );
        updateTips( "Length of " + n + " must be between " +
          min + " and " + max + "." );
        return false;
      } else {
        return true;
      }
    }
 
    function checkRegexp( o, regexp, n ) {
      if ( !( regexp.test( o.val() ) ) ) {
        o.addClass( "ui-state-error" );
        updateTips( n );
        return false;
      } else {
        return true;
      }
    }
 
    function addUser() {
      var valid = true;
      allFields.removeClass( "ui-state-error" );
 
      valid = valid && checkLength( name, "username", 3, 16 );
      valid = valid && checkLength( email, "email", 6, 80 );
      valid = valid && checkLength( password, "password", 5, 16 );
 
      valid = valid && checkRegexp( name, /^[a-z]([0-9a-z_\s])+$/i, "Username may consist of a-z, 0-9, underscores, spaces and must begin with a letter." );
      valid = valid && checkRegexp( email, emailRegex, "eg. ui@jquery.com" );
      valid = valid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
 
      if ( valid ) {
        $( "#users tbody" ).append( "<tr>" +
          "<td>" + name.val() + "</td>" +
          "<td>" + email.val() + "</td>" +
          "<td>" + password.val() + "</td>" +
        "</tr>" );
        dialog.dialog( "close" );
      }
      return valid;
    }
 
    dialog = $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 400,
      width: 350,
      modal: true,
      buttons: {
        "Create an account": addUser,
        Cancel: function() {
          dialog.dialog( "close" );
        }
      },
      close: function() {
        form[ 0 ].reset();
        allFields.removeClass( "ui-state-error" );
      }
    });
 
    form = dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      addUser();
    });
 
    $( "#create-user" ).button().on( "click", function() {
      dialog.dialog( "open" );
    });
  } );
  </script>
EOT;

$layout = 'admin-lte';
include(LAYOUT_PATH . $layout . DS . 'head.php');
include(LAYOUT_PATH . $layout . DS . 'header.php');
?>




<div id="dialog-form" title="Create new user">
  <p class="validateTips">All form fields are required.</p>
 
  <form>
    <fieldset>
      <label for="name">Name</label>
      <input type="text" name="name" id="name" value="Jane Smith" class="text ui-widget-content ui-corner-all">
      <label for="email">Email</label>
      <input type="text" name="email" id="email" value="jane@smith.com" class="text ui-widget-content ui-corner-all">
      <label for="password">Password</label>
      <input type="password" name="password" id="password" value="xxxxxxx" class="text ui-widget-content ui-corner-all">
 
      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
</div>
 
 
<div id="users-contain" class="ui-widget">
  <h1>Existing Users:</h1>
  <table id="users" class="ui-widget ui-widget-content">
    <thead>
      <tr class="ui-widget-header ">
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>John Doe</td>
        <td>john.doe@example.com</td>
        <td>johndoe1</td>
      </tr>
    </tbody>
  </table>
</div>
<button id="create-user">Create new user</button>





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
              colHeaders: ['분류', '이름', '등록일', '아이디', '비고'],
              columns: [
                {},
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
                  for (var i = 0, ilen = res.users.length; i < ilen; i++) {
                    row = [];
                    row[0] = res.users[i].category;
                    row[1] = res.users[i].name;
                    row[2] = res.users[i].regDate;
                    row[2] = res.users[i].uuid;
                    row[2] = res.users[i].etc;
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
