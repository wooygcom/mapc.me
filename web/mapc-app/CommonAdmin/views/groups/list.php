<?php
/**
 *
 * View
 *
 * @version 0.1
 *
 */
$v['head']['extension'] = <<< EOT
    <!-- DataTables -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
EOT;
$v['footer']['extension'] = <<< EOT
    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable({
                className: 'dt-body-right'
                });
        } );
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
              <h3 class="box-title">그룹</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="myTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>이름</th>
                  <th>상위그룹</th>
                  <th>구분</th>
                  <th>SLUG</th>
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
