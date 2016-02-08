<section class="content">

    <h1 class="page-header"><?= _('내 정보'); ?></h1>

    <!-- form start -->
    <form method="post" action="#" class="form-horizontal">

        <!-- Horizontal Form -->
        <div class="box box-info">

            <div class="box-header with-border">
                <h2 class="box-title"><?= _('기본정보'); ?></h2>
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    <label for="name_cvba" class="col-sm-2 control-label"><?= _('이름'); ?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name_cvba" name="name" name="mapc_title" placeholder="<?= _('당신의 이름은 무엇입니까?'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nick_cvba" class="col-sm-2 control-label"><?= _('별명'); ?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nick_cvba" name="nick" placeholder="<?= _('페이지에 표시할 이름을 넣어주세요.'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nick_cvba" class="col-sm-2 control-label"><?= _('표시할 이름 선택'); ?></label>
                    <div class="col-sm-10">
                        <input type="radio" name="display_name" value="name" class="minimal" /> <?= _('이름'); ?>
                        &nbsp;
                        <input type="radio" name="display_name" value="nick" class="minimal" /> <?= _('별명'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="profile_cvba" class="col-sm-2 control-label"><?= _('내 사진'); ?></label>
                    <div class="col-sm-10">
                        <input type="file" id="profile_cvba" name="profile" />
                        <p class="help-block"><?= _('첫 화면에 표시할 당신의 사진을 넣어주세요.'); ?></p>
                    </div>
                </div>

            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-default"><?= _('취소'); ?></button>
                <button type="submit" class="btn btn-info pull-right"><?= _('확인'); ?></button>
            </div><!-- /.box-footer -->

        </div>

        <div class="box box-info">

            <div class="box-header with-border">
                <h2 class="box-title"><?= _('부가정보'); ?></h2>
            </div><!-- /.box-header -->

            <div class="box-body">

                <div class="form-group">
                    <label for="birthday_cvba" class="col-sm-2 control-label">
                        <?= _('생년월일'); ?>
                        <input type="checkbox" name="open_birthday" class="minimal" /> 공개
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="birthday_cvba" name="birthday" placeholder="<?= _('태어난 날을 넣어주세요.') . ' ' . _('형식:YYYY-MM-DD'); ?>">
                    </div>
                </div>

                <!-- radio -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">
                        <?= _('성별'); ?>
                        <input type="checkbox" name="open_sex" class="minimal" /> 공개

                    </label>
                    <div class="col-sm-10">
                        <input type="radio" name="sex" value="m" class="minimal" /> <?= _('남성'); ?>
                        &nbsp;
                        <input type="radio" name="sex" value="f" class="minimal" /> <?= _('여성'); ?>
                    </div>
                </div>

            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-default"><?= _('취소'); ?></button>
                <button type="submit" class="btn btn-info pull-right"><?= _('확인'); ?></button>
            </div><!-- /.box-footer -->

        </div><!-- /.box -->

    </form>

</section>
