<section class="content">
    <h1 class="page-header">화일비교</h1>

    <form action="<?= $URL['core']['admin']; ?>core/compare-files-act/" method="post" class="form-horizontal">
          <div class="form-group">
            <label for="origin_oiuc" class="col-sm-1 control-label"><?= _('원본'); ?></label>
            <div class="col-sm-11">
              <input type="text" class="form-control" id="origin_oiuc" name="origin" placeholder="Original file path">
            </div>
          </div>
          <div class="form-group">
            <label for="target_oiuc" class="col-sm-1 control-label"><?= _('복사본'); ?></label>
            <div class="col-sm-11">
              <input type="text" class="form-control" id="target_oiuc" name="target" placeholder="Target file path">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-1 col-sm-11">
              <button type="submit" class="btn btn-primary"><?= _('확인'); ?></button>
            </div>
          </div>
    </form>
</section>
