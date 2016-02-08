<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 로그인 처리
 */

require(INIT_PATH . 'init.db.php');
{ // Model : Head

    { // BLOCK:process:20131004:회원활동 처리...

        $dbh = $CONFIG_DB['handler']; 

        $user_uid = $_POST['user_id'] ? $_POST['user_id'] : $ARGS['user_uid'];
        $process  = $_POST['process'];
        $mileage  = $_POST['mileage'];
        $date_reserve = $_POST['date_reserve'] . ' ' . $_POST['reserve_time'];
        $memo     = $_POST['memo'];

        $query = '
            insert into ' . $CONFIG_DB['prefix'] . 'user_log
               set user_uid = :user_uid,
                   action   = :action,
                   create_date = :create_date,
                   memo     = :memo
            ';

        $var = array(
            ':user_uid' => $user_uid,
            ':action'   => $process,
            ':create_date' => date('Y-m-d H:i:s'),
            ':memo'     => $memo
            );

        try {

            $sth = $dbh->prepare($query);
            $sth->execute($var);
            $return['success'] = true;
            
        } catch (Exception $e) {

            die(_('DB에 에러가 발생했습니다.'));
          
        }

    } // BLOCK

    { // BLOCK:detail_act:20131004

        switch($process) {
            case 'reserve': // 예약일 경우
                include_once MODULE_PATH . 'reserve/model/reserve.func.php';
                $product_uid  = $_POST['product_uid'] ? $_POST['product_uid'] : '';
                $product_name = '예약';
                $reserve_start  = $date_reserve;
                $reserve_finish = $date_reserve; // #TODO 기간을 입력받고 기간에 따라 마감일 정하도록...
                $args = array(
                    'user_uid'       => $user_uid,
                    'product_uid'    => $product_uid,
                    'product_name'   => $product_name,
                    'reserve_start'  => $reserve_start,
                    'reserve_finish' => $reserve_finish,
                    'memo' => $memo
                    );
                module_reserve_create($args);
                break;
        }

    } // BLOCK

} // Model : Tail

// ======================================================================

{ // View : Head

    $page_result = ($return['success']) ? 'success' : $return['message'];

    $VIEW['message'] = '등록되었습니다.';
    $VIEW['url']     = $URL['core']['admin'] . 'user/action/';
    $VIEW['display_type'] = 'html_alert';
    $VIEW['layout_file']  = 'html_simple.view.php';

} // View : Tail

// end of file
