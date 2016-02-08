<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 회원 리스트 처리
 */

require(INIT_PATH . 'init.auth.php');
{ // Model : Head

    { // BLOCK:arg_process:20150130:넘김값 정리

        $command = $_REQUEST['command'];
        $search_status = $_POST['search_status'];
        $search_name = $_POST['search_name'];
        $search_date_from = $_POST['search_date_from'];
        $search_date_to     = $_POST['search_date_to'];

        $seq = $_POST['seq'];
        $uid = $_POST['uid'];
        $etc = $_POST['etc'];

        if($command == 'list' || $command == 'new' || $command == 'edit' || $command == 'delete') {

            $name = $_POST['name'];
            $id = $_POST['id'];
            $user_type = $_POST['user_type'];
            $email = $_POST['email'];
            $status = $_POST['status'];
            
        } elseif($command == 'meta_list' || $command == 'meta_new' || $command == 'meta_edit' || $command == 'meta_delete') {

            $user_uid = $ARGS['user_id'];
            $meta_seq = $_POST['m_seq'];
            $key = $_POST['m_key'];
            $value = $_POST['m_value'];
            $desc = $_POST['m_desc'];

        }

        // more easy usage
        $dbh = $CONFIG_DB['handler'];

    } // BLOCK

    try
    {
        switch($command) {

            case 'list':
                { // BLOCK:list_get:20131101:리스트 가져오기

                    $where_sep = ' where ';
                    $where .= $where_sep . ' (user_type NOT IN ("admin", "manager", "role") OR user_type IS NULL) ';
                    $where_sep = ' and ';
                    $where .= $search_status ? $where_sep . " user_status = '" . $search_status . "'" : '';
                    if(! empty($search_date_from) && ! empty($search_date_to)) {
                        $where .= $where_sep . ' user_sign_up_date between "' . $search_date_from . ' 00:00:00" and "' . $search_date_to . ' 23:59:59"';
                    } elseif(! empty($search_date_from)) {
                        $where .= $where_sep . ' user_sign_up_date >= "' . $search_date_from . '"';
                    } elseif(! empty($search_date_to)) {
                        $where .= $where_sep . ' user_sign_up_date =< "' . $search_date_to . '"';
                    }
                    if(! empty($search_name)) {
                        $where .= $where_sep . ' user_name like "%' . $search_name . '%"';
                        $where_sep = ' and ';
                    }
                    // 최고 관리자가 아닐 경우... 자기 그룹 아래만 보이도록...
                    if($_SESSION['mapc_user_type'] != 'admin') {
                        $where .= $where_sep . ' fk_user_group_uid = "' . $_SESSION['mapc_user_group'] . '"';
                        $where_sep = ' and ';
                    }

                    if($ARGS['jtSorting']) {
    
                        $order_by = " ORDER BY user_" . str_replace("%20", ' ', $ARGS['jtSorting']);
    
                    }
    
                    if($ARGS['jtStartIndex'] || $ARGS['jtPageSize']) {
    
                        $limit = " LIMIT " . $ARGS['jtStartIndex'] . "," . $ARGS['jtPageSize'];
    
                    }

                    $query = "
                        SELECT COUNT(`user_seq`) as totalCount
                          FROM " . $CONFIG_DB['prefix'] . "user_info
                        ";
                    $query .= $where;
                    $sth = $CONFIG_DB['handler']->prepare($query);
                    $sth->execute();
                    $result = $sth->fetch(PDO::FETCH_ASSOC);
                    $recordCount = $result['totalCount'];
    
                    $query = "
                            SELECT `user_seq` as seq, `user_uid` as uid, `user_name` as name, `user_id` as id, `user_type` as user_type, `user_email` as email, `user_sign_up_date` as sign_up_date, `user_sign_in_date_latest` as sign_in_date_latest, `user_status` as status, `user_etc` as etc
                              FROM " . $CONFIG_DB['prefix'] . "user_info "
                            . $where
                            . $order_by
                            . $limit;
    
                    $sth = $CONFIG_DB['handler']->prepare($query);
                    $sth->execute();
    
                    while($result = $sth->fetch(PDO::FETCH_ASSOC)) {
    
                        $rows[] = $result;
    
                    }
    
                    $act_result = array();
                    $act_result['Result'] = "OK";
                    $act_result['Records'] = $rows;
                    $act_result['TotalRecordCount'] = $recordCount;
                        
                } // BLOCK
                break;

            case 'new':
                { // BLOCK:new_record:20131101:새로쓰기

                    $query = "
                        insert into " . $CONFIG_DB['prefix'] . "user_info
                           set user_name   = :name
                             , user_uid     = :id
                             , user_id     = :id
                             , user_email  = :email
                             , user_type   = :user_type
                             , user_status = :status
                             , user_sign_up_date = :sign_up_date
                             , user_etc    = :etc
                             , fk_user_group_uid = :group_uid
                        ";

                    $sth = $CONFIG_DB['handler']->prepare($query);
                    $where_var = array(
                        ':name' => $name,
                        ':uid'   => $id,
                        ':id'   => $id,
                        ':email'=> $email,
                        ':user_type'=> $user_type,
                        ':status'   => $status,
                        ':sign_up_date' => date('Y-m-d'), 
                        ':etc'  => $etc,
                        ':group_uid' => $_SESSION['mapc_user_group']
                        );

                    $sth->execute($where_var);

                    $result = $sth->errorInfo();

                    $act_result = array();
                    if($result[0] == '00000') {

                        $act_result['Result'] = "OK";

                        { // get latest inserted one. #TODO change for global DB(another sql server) LAST_INSERT_ID -> ???
                            $query = "SELECT * FROM " . $CONFIG_DB['prefix'] . "user_info WHERE user_seq = LAST_INSERT_ID()";
                            $sth = $CONFIG_DB['handler']->prepare($query);
                            $sth->execute();
                            $inserted_row = $sth->fetch();
                        }

                        $act_result['Record'] = $inserted_row;

                    } else {
                        $act_result['Result'] = "ERROR";
                    }

                } // BLOCK
                break;

            case 'edit':
                { // BLOCK:list_get:20131101:편집

                    $query = "
                        update " . $CONFIG_DB['prefix'] . "user_info
                           set user_name   = :name
                             , user_email  = :email
                             , user_type   = :user_type
                             , user_status = :status
                             , user_etc    = :etc
                         where user_seq = :seq
                        ";

                    $sth = $CONFIG_DB['handler']->prepare($query);
                    $var = array(
                        ':name' => $name,
                        ':email'=> $email,
                        ':user_type'=> $user_type,
                        ':status'   => $status,
                        ':etc'  => $etc,
                        ':seq'  => $seq
                        );
                    $sth->execute($var);

                    $result = $sth->errorInfo();

                    $act_result = array();
                    if($result[0] == '00000') {
                        $act_result['Result'] = "OK";
                    } else {
                        $act_result['Result'] = "ERROR";
                    }

                } // BLOCK
                break;

            case 'delete':
                { // BLOCK:list_get:20131101:지우기

                    $var = array();
                    $where_sep = ' where ';
                    $where = $where_sep . ' user_seq = :seq ';
                    $var[':seq'] = $seq;
                    $where_sep = ' and ';

                    if($_SESSION['mapc_user_type'] != 'admin') {
                        $where .= $where_sep . ' fk_user_group_uid = :group_uid ';
                        $var[':group_uid'] = $_SESSION['mapc_user_group'];
                        $where_sep = ' and ';
                    }

                    $query = "UPDATE " . $CONFIG_DB['prefix'] . "user_info
                                       SET user_status = 'deleted'
                                     " . $where;

                    $sth = $CONFIG_DB['handler']->prepare($query);
                    $sth->execute($var);
                    $result = $sth->errorInfo();

                    $act_result = array();
                    if($result[0] == '00000') {

                        $act_result['Result'] = "OK";

                    } else {

                        $act_result['Result'] = "Error";

                    }

                } // BLOCK
                break;

            case 'meta_list':
                { // BLOCK:meta_list:20131101:메타정보(지금당장은 전화번호만...)

                    $where = '
                         where (usermeta_user_uid = "' . $ARGS['user_id'] . '")
                           and usermeta_key like "phone_%"
                        ';

                    $query = '
                        SELECT COUNT(`usermeta_seq`) as totalCount
                          FROM ' . $CONFIG_DB['prefix'] . 'user_infometa
                        ';
                    $query .= $where;
                    $sth = $CONFIG_DB['handler']->prepare($query);
                    $sth->execute();
                    $result = $sth->fetch(PDO::FETCH_ASSOC);
                    $recordCount = $result['totalCount'];

                    $query = "
                            SELECT `usermeta_seq` as m_seq, `usermeta_user_uid` as m_uid, `usermeta_lang` as lang, `usermeta_key` as m_key, `usermeta_value` as m_value, `usermeta_desc` as m_desc, `usermeta_etc` as etc
                              FROM " . $CONFIG_DB['prefix'] . "user_infometa "
                            . $where;

                    $sth = $CONFIG_DB['handler']->prepare($query);
                    $sth->execute();

                    while($result = $sth->fetch(PDO::FETCH_ASSOC)) {
    
                        $rows[] = $result;
    
                    }
    
                    $act_result = array();
                    $act_result['Result'] = "OK";
                    $act_result['Records'] = $rows;
                    $act_result['TotalRecordCount'] = $recordCount;

                } // BLOCK
                break;

            case 'meta_new':
                { // BLOCK:meta_new:20131101:전화번호 추가

                    $query = "
                        insert into " . $CONFIG_DB['prefix'] . "user_infometa
                           set usermeta_user_uid   = :uid
                             , usermeta_key = :key
                             , usermeta_lang = :lang
                             , usermeta_value = :value
                             , usermeta_desc = :desc
                             , usermeta_etc = :etc
                        ";

                    $sth = $CONFIG_DB['handler']->prepare($query);
                    $var = array(
                        ':uid' => $user_uid,
                        ':key'   => $key,
                        ':lang'=> $lang,
                        ':value'=> $value,
                        ':desc'   => $desc,
                        ':etc'  => $etc
                        );
                    $sth->execute($var);

                    $result = $sth->errorInfo();

                    $act_result = array();
                    if($result[0] == '00000') {

                        $act_result['Result'] = "OK";

                        { // get latest inserted one. #TODO change for global DB(another sql server) LAST_INSERT_ID -> ???
                            $query = "SELECT `usermeta_seq` as seq, `usermeta_user_uid` as uid, `usermeta_lang` as lang, `usermeta_key` as m_key, `usermeta_value` as m_value, `usermeta_desc` as m_desc, `usermeta_etc` as etc
                                              FROM " . $CONFIG_DB['prefix'] . "user_infometa WHERE usermeta_seq = LAST_INSERT_ID()";
                            $sth = $CONFIG_DB['handler']->prepare($query);
                            $sth->execute();
                            $inserted_row = $sth->fetch();
                        }

                        $act_result['Record'] = $inserted_row;

                    } else {

                        $act_result['Result'] = "ERROR";

                    }

                } // BLOCK
                break;
                
            case 'meta_edit':
                { // BLOCK:meta_edit:20131101:전화번호 편집

                    $query = "
                        update " . $CONFIG_DB['prefix'] . "user_infometa
                           set usermeta_key = :key
                             , usermeta_lang = :lang
                             , usermeta_value = :value
                             , usermeta_desc = :desc
                             , usermeta_etc = :etc
                         where usermeta_seq = :m_seq
                        ";

                    $sth = $CONFIG_DB['handler']->prepare($query);
                    $var = array(
                        ':key'   => $key,
                        ':lang'=> $lang,
                        ':value'=> $value,
                        ':desc'   => $desc,
                        ':etc'  => $etc,
                        ':m_seq' => $meta_seq
                        );
                    $sth->execute($var);

                    $result = $sth->errorInfo();

                    $act_result = array();
                    if($result[0] == '00000') {
                        $act_result['Result'] = "OK";
                    } else {
                        $act_result['Result'] = "ERROR";
                    }

                } // BLOCK
                break;
                
            case 'meta_delete':
                { // BLOCK:meta_delete:20131101:전화번호 삭제

                    $query = "DELETE FROM " . $CONFIG_DB['prefix'] . "user_infometa WHERE usermeta_seq = :m_seq";
                    $sth = $CONFIG_DB['handler']->prepare($query);
                    $sth->execute(array(':m_seq' => $meta_seq));
                    $result = $sth->errorInfo();

                    $act_result = array();
                    if($result[0] == '00000') {

                        $act_result['Result'] = "OK";

                    } else {

                        $act_result['Result'] = "Error";

                    }

                } // BLOCK
                break;
                                
        }
    }
    catch(Exception $ex)
    {

        //Return error message
        $act_result = array();
        $act_result['Result'] = "ERROR";
        $act_result['Message'] = $ex->getMessage();

    }

} // Model : Tail

// ======================================================================

{ // View : Head

	{ // BLOCK:echo_view:20130923:화면출력

        print json_encode($act_result);
        exit;

	}

} // View : Tail

// end of file
