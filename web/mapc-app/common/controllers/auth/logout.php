<?php
include(SYSTEM_PATH . 'library/http_move.php');

session_destroy();

$reffererUrl = isset($_REQUEST['reffererUrl']) ? $_REQUEST['reffererUrl'] : '';

if (empty($reffererUrl)){

    $pUrl=ROOT_URL . "smu/users/signin";

} else {

    $pUrl=$reffererUrl;

}

httpMove(200, $pUrl);

exit;

// this is it
