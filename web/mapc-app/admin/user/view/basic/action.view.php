<section class="col-md-6 col-md-offset-3">

    <h1 class="page-header"><?= _('활동기록'); ?></h1>

    <form method="post" action="<?= $URL['core']['admin']; ?>user/action-act/" class="form-signin">

        <div class="form-group">
            <label for="user_id">
                <?= _('처리'); ?>
            </label>
            <select id="detail_widk" name="process" class="form-control" autofocus="autofocus">
                <option value="reserve">예약</option>
                <option value="milage_plus">마일리지 적립(+)</option>
                <option value="milage_minus">마일리지 차감(-)</option>
            </select>
        </div>

        <div class="form-group detail_mileage">
            <label for="mileage_widk">
                <?= _('마일리지'); ?>
            </label>
            <input id="mileage_widk" name="mileage" type="text" class="form-control" placeholder="<?= _('출석ID'); ?>">
        </div>

        <div class="form-group detail_reserve">
            <label for="date_reserve_widk">
                <?= _('날짜'); ?>
            </label>
            <input id="date_reserve_widk" name="date_reserve" type="text" class="form-control" placeholder="형식 : <?= date('Y-m-d'); ?>">
            <select name="reserve_time" class="form-control">
                <?php
                    for($i=0; $i<24; $i++) {
                        $temp_time  = sprintf("%02d", $i) . ':00';
                        $temp_time2 = ($i < 13) ? sprintf("%02d", $i) . ':00' : sprintf("%02d", $i - 12) . ':00';
                        $temp_selected = ($i == 13) ? ' selected="selected" ' : '';
                ?>
                    <option value="<?= $temp_time; ?>" <?= $temp_selected; ?>><?= ($i < 12) ? _('오전'): _('오후'); ?> <?= $temp_time2; ?></option>
                <?php
                    }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="memo_widk">
                <?= _('메모'); ?>
            </label>
            <input id="memo_widk" name="memo" type="text" class="form-control" placeholder="<?= _('메모'); ?>">
        </div>

        <div class="form-group">
            <label for="user_id_widk">
                <?= _('ID'); ?>
            </label>
            <input id="user_id_widk" name="user_id" type="text" class="form-control" placeholder="<?= _('ID'); ?>">
        </div>

        <div id="messageBox_diwq" style="color:#f00;">
            <?= $user_name ? $user_name . ' / ' : ''; ?><?= $result; ?>
        </div>

        <div class="form-group">
            <button class="btn btn-lg btn-primary btn-block" type="submit"><?= _('등록'); ?></button>
        </div>

    </form>

</section>
