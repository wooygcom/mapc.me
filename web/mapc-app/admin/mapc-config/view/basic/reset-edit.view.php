<section class="content">

    <h1 class="page-header">초기화</h1>

    <!-- form start -->
    <form method="post" action="#" role="form">

        <!-- Horizontal Form -->
        <div class="box box-danger">

            <div class="box-header with-border">
                <h2 class="box-title"><?= _('초기화 확인'); ?></h2>
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    <label for="understd_reset" class="control-label">
                        <?= _('초기화가 완료된 이후에는 복구가 불가능합니다.'); ?>
                    </label>
                    <br />
                    <input type="checkbox" name="understd_reset" class="minimal" /> <?= _('네, 이해했습니다.'); ?>
                </div>
                <div class="form-group">
                    <label for="captcha_check" class="control-label">
                        <?= _('초기화 문자'); ?> : 1234 <?php // #TODO CAPTCHA코드 생성 하는 프로그램 필요; ?>
                        <br />
                        <?= _('위의 초기화 문자를 똑같이 입력하시고 "확인"을 누르세요.'); ?>
                    </label>
                    <input type="text" name="captcha_check" class="form-control" />
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-default"><?= _('취소'); ?></button>
                <button type="submit" class="btn btn-info pull-right"><?= _('확인'); ?></button>
            </div><!-- /.box-footer -->

        </div>

    </form>

</section>
