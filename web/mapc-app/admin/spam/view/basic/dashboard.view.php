<section class="content">

    <h1 class="page-header"><?= _('차단 설정'); ?></h1>

    <div class="row">
        <div class="col-md-6">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <!-- form start -->
                <form method="post" action="^">
                    <div class="box-header with-border">
                        <h2 class="box-title"><?= _('IP 차단'); ?></h2>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="input-group input-group-sm">
                            <input type="text" name="block_content_add" class="form-control">
                            <span class="input-group-btn">
                              <button class="btn btn-info btn-flat" type="button"><?= _('추가'); ?></button>
                            </span>
                        </div><!-- /input-group -->
                        <p class="help-block">
                            191.0.0.1~255 를 차단하려면 191.0.0.* 와 같이 별표를 입력하세요.
                        </p>
                    </div>
                    <div class="box-body pad">
                        <textarea id="editor1" name="block_ip" rows="10" class="col-xs-12"></textarea>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-default"><?= _('취소'); ?></button>
                        <button type="submit" class="btn btn-info pull-right"><?= _('확인'); ?></button>
                    </div><!-- /.box-footer -->
                </form>
            </div>
        </div>

        <div class="col-md-6">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <!-- form start -->
                <form method="post" action="^">
                    <div class="box-header with-border">
                        <h2 class="box-title"><?= _('내용 차단'); ?></h2>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="input-group input-group-sm">
                            <input type="text" name="block_content_add" class="form-control">
                            <span class="input-group-btn">
                              <button class="btn btn-info btn-flat" type="button"><?= _('추가'); ?></button>
                            </span>
                        </div><!-- /input-group -->
                        <p class="help-block">
                            차단하려는 내용을 입력하고 '추가'를 누르세요.
                        </p>
                    </div>
                    <div class="box-body pad">
                        <textarea id="editor1" name="block_content" rows="10" class="col-xs-12"></textarea>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-default"><?= _('취소'); ?></button>
                        <button type="submit" class="btn btn-info pull-right"><?= _('확인'); ?></button>
                    </div><!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>

</section>
