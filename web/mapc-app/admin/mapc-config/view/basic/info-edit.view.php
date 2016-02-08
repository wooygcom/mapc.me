<section class="content">

    <h1 class="page-header">맵시정보</h1>

    <!-- form start -->
    <form method="post" action="#" class="form-horizontal">

        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h2 class="box-title"><?= _('기본정보'); ?></h2>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="form-group">
                    <label for="mapc_title_cvba" class="col-sm-2 control-label"><?= _('제목'); ?></label>
                    <div class="col-sm-10">
                        <input type="text" id="mapc_title_cvba" name="mapc_title" placeholder="<?= _('맵시의 제목을 넣어주세요.'); ?>" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="desc_cvba" class="col-sm-2 control-label"><?= _('소개글'); ?></label>
                    <div class="col-sm-10">
                        <textarea id="desc_cvba" name="desc" rows="3" placeholder="<?= ('소개글을 입력해주세요.'); ?>" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="main_image_cvba" class="col-sm-2 control-label"><?= _('대문사진'); ?></label>
                    <div class="col-sm-10">
                        <input type="file" id="main_image_cvba" name="main_image" />
                        <p class="help-block">첫 화면에 표시할 사진을 넣어주세요.</p>
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
