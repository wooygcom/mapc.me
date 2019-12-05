<?php
$layout = 'core';

include(LAYOUT_PATH . $layout . '/head.php');
include(LAYOUT_PATH . $layout . '/header.php');
print_r($v);
?>

<div class="content_view">
    <?= $v['foo']; ?>
</div>

<?php
include(LAYOUT_PATH . $layout . '/footer.php');
include(LAYOUT_PATH . $layout . '/foot.php');

// this is it
