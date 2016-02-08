<section class="content">

    <h1 class="page-header"><?= _('댓글 권한'); ?></h1>

    <!-- form start -->
    <form method="post" action="^" class="form-horizontal">

        <!-- Horizontal Form -->
        <div class="box box-info">

            <div class="box-header with-border">
                <h2 class="box-title"><?= _('댓글 권한'); ?></h2>
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    <label for="ccl_attribution" class="col-sm-2 control-label">
                        <?= _('기본 댓글'); ?>
                    </label>
                    <div class="col-sm-10">
                        <input type="radio" name="default_reply" value="normal" class="minimal" checked="checked" /> <?= _('일반'); ?>
                        &nbsp;
                        <input type="radio" name="default_reply" value="secret" class="minimal" /> <?= _('비밀'); ?>
                        <p class="help-block"><?= _('댓글의 기본 성격을 정합니다.'); ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="ccl_attribution" class="col-sm-2 control-label">
                        <?= _('익명사용자 댓글'); ?>
                    </label>
                    <div class="col-sm-10">
                        <input type="radio" name="anonymous" value="allow" class="minimal" /> <?= _('허용'); ?>
                        &nbsp;
                        <input type="radio" name="anonymous" value="deny" class="minimal" checked="checked" /> <?= _('불허'); ?>
                        <p class="help-block"><?= _('익명사용자의 댓글을 허용할 지 여부를 결정합니다.'); ?></p>
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
