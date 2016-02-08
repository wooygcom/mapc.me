<section class="content">

    <h1 class="page-header"><?= _('^페이지내용'); ?></h1>

    <!-- form start -->
    <form method="post" action="^" class="form-horizontal">

        <!-- Horizontal Form -->
        <div class="box box-info">

            <div class="box-header with-border">
                <h2 class="box-title"><?= _('^소제목'); ?></h2>
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    <label for="ccl_attribution" class="col-sm-2 control-label">
                        <?= _('^라디오'); ?>
                    </label>
                    <div class="col-sm-10">
                        <input type="radio" name="^name" value="^yes" class="minimal" checked="checked" /> <?= _('^네'); ?>
                        &nbsp;
                        <input type="radio" name="^name" value="^no" class="minimal" checked="checked" /> <?= _('^아니요'); ?>
                        <p class="help-block"><?= _('^설명문은 여기에...'); ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="ccl_attribution" class="col-sm-2 control-label">
                        <?= _('^텍스트'); ?>
                    </label>
                    <div class="col-sm-10">
                        <input type="text" name="^name" class="minimal" placeholder="<?= _('^placeholder'); ?>" />
                        <p class="help-block"><?= _('^설명문은 여기에...'); ?></p>
                    </div>
                </div>

            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-default"><?= _('취소'); ?></button>
                <button type="submit" class="btn btn-info pull-right"><?= _('확인'); ?></button>
            </div><!-- /.box-footer -->

        </div>

    </form>

</section>
