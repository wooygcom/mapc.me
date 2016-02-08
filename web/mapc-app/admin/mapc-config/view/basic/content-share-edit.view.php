<section class="content">

    <h1 class="page-header"><?= _('퍼가기 설정'); ?></h1>

    <!-- form start -->
    <form method="post" action="#" class="form-horizontal">

        <!-- Horizontal Form -->
        <div class="box box-info">

            <div class="box-header with-border">
                <h2 class="box-title"><?= _('CCL 설정'); ?></h2>
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    <label for="ccl_attribution" class="col-sm-2 control-label">
                        <?= _('원저작자 표시'); ?>
                    </label>
                    <div class="col-sm-10">
                        <input type="radio" name="ccl_attribution" value="show" class="minimal" checked="checked" /> <?= _('표시'); ?>
                        &nbsp;
                        <input type="radio" name="ccl_attribution" value="hidden" class="minimal" disabled="disabled" /> <?= _('표시안함'); ?>
                        <p class="help-block"><?= _('저작자의 이름, 출처 등 저작자를 반드시 표시 해야 한다는, 라이선스에 반드시 포함하는 필수조항 입니다.'); ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="ccl_commercial" class="col-sm-2 control-label">
                        <?= _('영리목적의 사용'); ?>
                    </label>
                    <div class="col-sm-10">
                        <input type="radio" name="ccl_commercial" value="allow" class="minimal" /> <?= _('허락'); ?>
                        &nbsp;
                        <input type="radio" name="ccl_commercial" value="deny" class="minimal" checked="checked" /> <?= _('불허'); ?>
                        <p class="help-block"><?= _('저작물을 영리 목적으로 이용할 수 없습니다. 영리목적의 이용을 위해서는, 별도의 계약이 필요하다는 의미입니다.'); ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="ccl_derivative_works" class="col-sm-2 control-label">
                        <?= _('저작물의 변경 또는 2차 저작'); ?>
                    </label>
                    <div class="col-sm-10">
                        <input type="radio" name="ccl_derivative_works" value="allow" class="minimal" /> <?= _('허락'); ?>
                        &nbsp;
                        <input type="radio" name="ccl_derivative_works" value="deny" class="minimal" checked="checked" /> <?= _('불허'); ?>
                        <p class="help-block"><?= _('저작물을 변경하거나 저작물을 이용한 2차적 저작물 제작을 금지한다는 의미입니다.'); ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="ccl_share_alike" class="col-sm-2 control-label">
                        <?= _('동일조건 변경허락'); ?>
                    </label>
                    <div class="col-sm-10">
                        <input type="radio" name="ccl_share_alike" value="allow" class="minimal" /> <?= _('허락'); ?>
                        &nbsp;
                        <input type="radio" name="ccl_share_alike" value="deny" class="minimal" checked="checked" /> <?= _('불허'); ?>
                        <p class="help-block"><?= _('2차적 저작물 제작을 허용하되, 2차적 저작물에 원 저작물과 동일한 라이선스를 적용해야 한다는 의미입니다.'); ?></p>
                    </div>
                </div>

            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-default"><?= _('취소'); ?></button>
                <button type="submit" class="btn btn-info pull-right"><?= _('확인'); ?></button>
            </div><!-- /.box-footer -->

        </div>

        <!-- Horizontal Form -->
        <div class="box box-info">

            <div class="box-header with-border">
                <h2 class="box-title"><?= _('기타 설정'); ?></h2>
            </div><!-- /.box-header -->

                <div class="form-group">
                    <label for="share" class="col-sm-2 control-label"><?= _('퍼가기'); ?></label>
                    <div class="col-sm-10">
                        <input type="radio" name="share" value="allow" class="minimal" /> <?= _('허락'); ?>
                        &nbsp;
                        <input type="radio" name="share" value="deny" class="minimal" checked="checked" /> <?= _('불허'); ?>
                        <p class="help-block"><?= _('자료 퍼가기를 기술적으로 가능한 범위안에서 제한합니다.'); ?></p>
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
