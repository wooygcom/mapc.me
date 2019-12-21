<?php
if(!defined("__MAPC__")) { exit(); }

include(PROC_PATH   . 'proc.autoload.php'); // Mapc 내부 패키지 불러오기 위해서
include(VENDOR_PATH . 'autoload.php'); // compoesr 패키지 불러오기 위해서

use Mapc\CommonAdmin\UsersAdmin;

$db    = include(PROC_PATH . 'proc.db.php');

$users = new UsersAdmin(['table' => 'mc_user_info']);

try {
  
    $colMap = array(
      0 => 'user_group',
      1 => 'user_name',
      2 => 'user_sign_up_date',
      3 => 'user_id',
      4 => 'user_etc'
    );
  
    if (isset($_POST['changes']) && $_POST['changes']) {
        foreach ($_POST['changes'] as $change) {
            $rowId  = $change[0] + 1;
            $colId  = $change[1];
            $newVal = $change[3];
            
            if (!isset($colMap[$colId])) {
              echo "\n error!";
              continue;
            }

            $field = $colMap[$colId];

            $users->vars->id = $rowId;
            $users->vars->{$field} = $newVal;
            $users->create();
        }

    } elseif (isset($_POST['data']) && $_POST['data']) {

        for ($r = 0, $rlen = count($_POST['data']); $r < $rlen; $r++) {
            $rowId = $r + 1;
            for ($c = 0, $clen = count($_POST['data'][$r]); $c < $clen; $c++) {
                if (!isset($colMap[$c])) {
                    continue;
                }
                
                $newVal = $_POST['data'][$r][$c];

                $field = $colMap[$c];

                $users->id = $rowId;
                $users->{$field} = $newVal;

                $users->create();

              }
        }

/*
        $select = $db->prepare('DELETE FROM users');
        $select->execute();
        
        for ($r = 0, $rlen = count($_POST['data']); $r < $rlen; $r++) {
            $rowId = $r + 1;
            for ($c = 0, $clen = count($_POST['data'][$r]); $c < $clen; $c++) {
                if (!isset($colMap[$c])) {
                    continue;
                }
                
                $newVal = $_POST['data'][$r][$c];
                
                $select = $db->prepare('SELECT id FROM users WHERE id=? LIMIT 1');
                $select->execute(array(
                    $rowId
                ));
                
                if ($row = $select->fetch()) {
                    $query = $db->prepare('UPDATE users SET `' . $colMap[$c] . '` = :newVal WHERE id = :id');
                } else {
                    $query = $db->prepare('INSERT INTO users (id, `' . $colMap[$c] . '`) VALUES(:id, :newVal)');
                }
                $query->bindValue(':id', $rowId, PDO::PARAM_INT);
                $query->bindValue(':newVal', $newVal, PDO::PARAM_STR);
                $query->execute();
              }
        }
*/
    }

    $out = array(
      'result' => 'ok'
    );
    echo json_encode($out);
  
}
catch (PDOException $e) {
  print 'Exception : ' . $e->getMessage();
}
?>