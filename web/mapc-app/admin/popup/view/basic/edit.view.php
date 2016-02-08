<?php
    if($VIEW['popup_detail']['banner']) {

        $temp_message_banner = '<p>화일을 새로 올리면 ' . $VIEW['popup_detail']['banner'] . '은 삭제됩니다.</p>';

    }
    if($VIEW['popup_detail']['popup_active']) {

        $temp_active_checked = ' checked="checked" ';

    }
    switch($ARGS['result']) {
        case 'success':
            $temp_result = '완료';
            break;
        case 'error':
            $temp_result = '서버에 이상이 생겼습니다. 잠시 후 다시 시도해주시기 바랍니다.';
            break;
        default:
            break;
    }
?>


<!-- Main content -->
<section class="content">

  <h1 class="page-header">팝업</h1>

  <form method="post" action="<?= $URL['core']['root']; ?>admin-popup/edit_act/" enctype="multipart/form-data">
      <input type="hidden" name="seq" value="<?= $VIEW['popup_detail']['seq']; ?>" />
      <div class="form-group">
        <label for="title"><?= _('팝업제목'); ?></label>
        <input type="text" class="form-control" id="title" name="title" value="<?= $VIEW['popup_detail']['title']; ?>" placeholder="<?= _('팝업제목'); ?>" required="required">
      </div>
      <div class="form-group">
        <label for="link"><?= _('링크'); ?></label>
        <input type="text" class="form-control" id="link" name="link" value="<?= $VIEW['popup_detail']['link']; ?>" placeholder="<?= _('http://url'); ?>" required="required">
      </div>
      <div class="form-group">
        <label for="content"><?= _('내용'); ?></label>
        <textarea class="form-control" id="content" name="content"><?= $VIEW['popup_detail']['content']; ?></textarea>
      </div>
      <div class="form-group">
        <label for="expire_date"><?= _('게시기한'); ?></label>
        <input type="datetime" class="form-control" id="expire_date" name="expire_date" value="<?= $VIEW['popup_detail']['expire_date']; ?>">
      </div>
      <div class="form-group">
        <label for="banner"><?= _('화일'); ?></label>
        <input type="file" id="banner" name="banner">
      </div>
      <div class="form-group" style="color:#ff0000">
          <?= $temp_message_banner; ?>
      </div>
      <div class="form-group">
        <label for="active"><?= _('활성화'); ?></label>
        <input type="checkbox" id="popup_active" name="popup_active" <?= $temp_active_checked; ?>>
      </div>
      <div class="form-group" style="color:#ff0000">
          <?= $temp_result; ?>
      </div>
    <button type="submit" class="btn btn-primary btn-lg"><?= _('전송'); ?></button>
  </form>

</section>


<link rel="stylesheet" href="<?= $URL['core']['root']; ?>vendor/jquery-ui/themes/smoothness/jquery-ui.css">

<script src="<?= $URL['core']['root']; ?>vendor/jquery/dist/jquery.min.js"></script>
<script src="<?= $URL['core']['root']; ?>vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="<?= $URL['core']['root']; ?>vendor/jquery-ui/ui/minified/i18n/datepicker-ko.min.js"></script>
<script>
    $.datepicker.setDefaults($.datepicker.regional['ko']);
    $( "#expire_date" ).datepicker();
</script>

<script src="<?= $URL['core']['root']; ?>vendor/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?= $URL['core']['root']; ?>vendor/jquery-validation/src/localization/messages_ko.js"></script>
<script>
    $('#askform').validate();
</script>
