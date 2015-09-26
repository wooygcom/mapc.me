<section>

    <form method="post" action="<?= $URL['user']['sign_up_act']; ?>" class="form-signin" role="form">

        <h1 class="form-signin-heading"><?= _('가입'); ?></h1>

        <input type="hidden" name="user_group" value="<?= $VIEW['body']['user_group']; ?>"/>
        <input type="hidden" name="user_uid" value="<?= $user_info['user_uid']; ?>"/>

        <div class="form-group">
            <label>
                <?= _('이름'); ?>
            </label>
            <input type="text" name="user_name" value="<?= $user_info['user_name']; ?>" class="form-control" placeholder="<?= _('이름'); ?>" />
        </div>

        <div class="form-group">
            <label>
                <?= _('이메일'); ?>
            </label>
            <input type="text" name="user_email" value="<?= $user_info['user_email']; ?>" class="form-control" placeholder="<?= _('이메일'); ?>" />
        </div>

        <div class="form-group">
            <label>
                <?= _('암호'); ?>
            </label>
            <input type="password" name="user_passwd" value="" class="form-control" placeholder="<?= _('암호'); ?>" />
        </div>

        <div class="form-group">
            <label>
                <?= _('암호 확인'); ?>
            </label>
            <input type="password" name="user_passwd_confirm" value="" class="form-control" placeholder="<?= _('암호 확인'); ?>" />
        </div>

        <div class="form-group">
            <button type="submit" value="submit" class="btn btn-lg btn-primary btn-block" /><?= _('가입'); ?></button>
        </div>

    </form>

</section>
