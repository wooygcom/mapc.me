<?php
/**
 *
 * View
 *
 * @version 0.1
 *
 */
/*
<script src="https://cdn.jsdelivr.net/npm/handsontable@7.2.2/dist/handsontable.full.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/handsontable@7.2.2/dist/handsontable.full.min.css" rel="stylesheet" media="screen">
*/
$v['head']['extension'] = <<< EOT
<script src="../npm/handsontable/handsontable.full.min.js"></script>
<link href="../npm/handsontable/handsontable.full.min.css" rel="stylesheet" media="screen">
EOT;

$layout = 'core';
include(LAYOUT_PATH . $layout . DS . 'head.php');
include(LAYOUT_PATH . $layout . DS . 'header.php');
?>

<div id="example"></div>

<?php
$v['footer']['extension'] = <<< EOT
<script>
var data = [
  ['', 'Ford', 'Tesla', 'Toyota', 'Honda'],
  ['2017', 10, 11, 12, 13],
  ['2018', 20, 11, 14, 13],
  ['2019', 30, 15, 12, 13]
];

var container = document.getElementById('example');
console.log(data);
var hot = new Handsontable(container, {
  data: data,
  width: '80%',
  colHeaders: true,
  filters: true,
  columnSorting: true
});
</script>
EOT;

include(LAYOUT_PATH . $layout . DS . 'footer.php');
include(LAYOUT_PATH . $layout . DS . 'foot.php');

// this is it
