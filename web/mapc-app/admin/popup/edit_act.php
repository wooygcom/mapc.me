<?php
if(!defined('__MAPC__')) { exit(); }

require(INIT_PATH . 'init.db.php');
{ // MODEL : Start

    { // BLOCK:init:20150904

        $seq     = $_POST['seq'];
        $title   = $_POST['title'];
        $link    = $_POST['link'];
        $content = $_POST['content'];
        $expire_date = $_POST['expire_date'];
        $active  = ($_POST['popup_active'] == 'on') ? 1 : 0;

        $save_dir = DATA_PATH . 'popup/';

        // seq값이 있고(기존글 편집)
        if(! empty($seq)) {

            include(__DIR__ . '/model/popup_get_banner.func.php');
            $old_file_name = popup_get_banner($seq);

            // 화일이 업로드 됐을 경우 기존화일 삭제...
            if(!empty($_FILES['banner']['name'])) {

                unlink($save_dir . $old_file_name);
                unset($sth, $result);

            } else {

                $file_name_save = $old_file_name;

            }

        }

    } // BLOCK

    if(! $file_name_save)
    { // BLOCK:file_upload:20150903

        // #TODO 화일업로드 함수를 만들어야 될듯...(업로드화일 보안점검기능도 필요...)

        $upload_file = basename($_FILES['banner']['name']);
        $file_info   = pathinfo($upload_file);
        $file_name   = $file_info['filename'];
        $file_ext    = $file_info['extension'];

        // 디렉토리가 없을 경우 생성
        if(!is_dir($save_dir)){
            // 디렉토리 구분자로 슬래시(/)를 인식못하는 OS의 경우 백슬래시로 바꿔줌
            $tmp_dir_name = (PHP_OS == 'WINNT') ? str_replace("/", "\\", $save_dir) : $save_dir;
            @mkdir($tmp_dir_name, 0777);
        }

        $file_name_save = $file_name . '.' . $file_ext;
        // Check duplication of file
        if(is_file($save_dir . $file_name_save)) {

            $file_name_save = $file_name . date('YmdHis') . rand(1000, 9999) . '.' . $file_ext;

        }

        if (move_uploaded_file($_FILES['banner']['tmp_name'], $save_dir . $file_name_save)) {

            $VIEW['message'] = "file_uploaded";

        } else {

            $VIEW['message'] = "file_upload_error";

        }

    } // BLOCK

    { // BLOCK:insert_db:20150903

        if(! $seq) {

            $query = '
                insert into ' . $CONFIG_DB['prefix'] . 'popup_info
                   set popup_title   = :title
                     , popup_link    = :link
                     , popup_content = :content
                     , popup_expire_date = :expire_date
                     , popup_banner  = :banner
                     , popup_active  = :active
                     , popup_seq = :seq
                ';
        } else {

            $query = '
                update ' . $CONFIG_DB['prefix'] . 'popup_info
                   set popup_title   = :title
                     , popup_link    = :link
                     , popup_content = :content
                     , popup_expire_date = :expire_date
                     , popup_banner  = :banner
                     , popup_active  = :active
                 where popup_seq = :seq
                ';

        }

        $sth = $CONFIG_DB['handler']->prepare($query);
        $sth->execute(
            array(
                ':seq'         => $seq,
                ':title'       => $title,
                ':link'        => $link,
                ':content'     => $content,
                ':expire_date' => $expire_date,
                ':banner'      => $file_name_save,
                ':active'      => $active
            )
        );

    } // BLOCK

} // MODEL : Finish

{ // View : Start

    if(!$error) {
        header('location:' . $URL['core']['root'] . 'admin-popup/list/result/success/');
    } else {
        header('location:' . $URL['core']['root'] . 'admin-popup/list/result/error/');
    }

} // View : Finish

// this is it
