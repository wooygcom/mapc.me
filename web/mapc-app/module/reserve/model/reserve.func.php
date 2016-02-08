<?php
/**
 * Reserve Create
 *
 * @param str $args['uid']
 * @param str $args['product_uid']
 * @param str $args['reserve_start']
 * @param str $args['reserve_finish']
 * @param str $args['memo']
 */
function module_reserve_create($args) {

    global $CONFIG_DB;
    $dbh = $CONFIG_DB['handler'];

    include_once(LIBRARY_PATH . 'mapc/string_key_gen.func.php');

    // uid, product_uid, product_name, reserve_start, reserve_finish, create_date, modify_date, memo
    $query = '
        insert into ' . $CONFIG_DB['prefix'] . 'reserve
           set uid = :uid,
               product_uid  = :product_uid,
               product_name = :product_name,
               reserve_start  = :reserve_start,
               reserve_finish = :reserve_finish,
               create_date  = :create_date,
               user_name    = :user_name,
               fk_user_uid  = :user_uid,
               fk_user_group_uid = :user_group_uid,
               memo         = :memo
        ';

    if($args['user_uid']) {

        include_once(MODULE_PATH . 'user/model/infoGet.func.php');
        $temp_info      = Mapc\Module\User\infoGet($args['user_uid']);
        $user_name      = $temp_info['user_name'];
        $user_group_uid = $temp_info['user_group_uid'];

    } else {

        $user_name      = $user_uid;
        $user_group_uid = '';

    }

    $var = array(
        ':uid'  => mapc_string_key_gen(),
        ':product_uid'    => $args['product_uid'],
        ':product_name'   => $args['product_name'],
        ':reserve_start'  => $args['reserve_start'],
        ':reserve_finish' => $args['reserve_finish'],
        ':create_date'    => date('Y-m-d H:i:s'),
        ':user_uid'       => $args['user_uid'],
        ':user_name'      => $user_name,
        ':user_group_uid' => $user_group_uid,
        ':memo'           => $args['memo']
        );

    try {

        $sth = $dbh->prepare($query);
        $sth->execute($var);

    } catch (Exception $e) {

        die(_('DB에 에러가 발생했습니다.'));

    }

    return true;
}

// end of file
