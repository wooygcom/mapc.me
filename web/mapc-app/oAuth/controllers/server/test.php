<?php
if(!defined("__MAPC__")) { exit(); }

include(VENDOR_PATH . 'autoload.php'); // compoesr 패키지 불러오기 위해서
include(PROC_PATH   . 'proc.autoload.php'); // Mapc 내부 패키지 불러오기 위해서

use Mapc\Rankbest\Item as Item;
use Mapc\Rankbest\Thesaurus as Thesaurus;

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    // POST값이 들어오면 "실행"
    switch($_POST['_method']) {
        case 'post':
        case 'put':
        case 'patch':
        case 'delete':
        default:
            // 
            break;
    }

} else {

    $search = $_GET['search'] ? $_GET['search'] : $ROUTES['option'];

    $db     = include(PROC_PATH . 'proc.db.php');

    $item = new Item(['db' => $db, 'table' => 'items']);

    $v['itemsList'] = $item->search([
        'searchField' => 'parent_slug',
        'searchValue' => $ROUTES['option']
    ]);

}

// this is it
