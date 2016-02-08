<?php
if(DEBUG_MODE) {
?>
      <link rel="stylesheet" href="<?= $URL['core']['root']; ?>vendor/jquery-ui/themes/start/jquery-ui.css">
<?php
} else {
?>
      <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/start/jquery-ui.css">
<?php
}
