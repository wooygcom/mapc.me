<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 페이지 설명
 */

require(INIT_PATH.'init.db.php');
{ // Model : Head

} // Model : Tail

// ======================================================================

// 일반적인 경우

{ // View : Head

} // View : Tail

// end of file



?>

<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 페이지 설명
 */

require(INIT_PATH.'init.auth.php');
{ // Model : Head

    switch ($_POST['_method']) {
        case 'post':
            // code...
            break;

        case 'patch':
            // code...
            break;

        case 'delete':
            // code...
            break;

        default:
            //
            exit;
            break;
    }

} // Model : Tail

// ======================================================================

// 일반적인 경우

{ // View : Head

} // View : Tail

// end of file
