<?php
{ // BLOCK:set_menu_file:20151012

    // admin page vs normal page
    if(PAGE_TYPE == 'admin') {

        $menu_user  = CONFIG_PATH . 'menu/admin.user.'  . $_SESSION['mapc_user_uid']   . '.php';
        $menu_group = CONFIG_PATH . 'menu/admin.group.' . $_SESSION['mapc_user_group'] . '.php';
        $menu_role  = CONFIG_PATH . 'menu/admin.role.'  . $_SESSION['mapc_user_role']  . '.php';
        $menu_core  = CONFIG_PATH . 'menu/admin.core.php';

    } else {

        $menu_user  = CONFIG_PATH . 'menu/main.user.'  . $_SESSION['mapc_user_uid']   . '.php';
        $menu_group = CONFIG_PATH . 'menu/main.group.' . $_SESSION['mapc_user_group'] . '.php';
        $menu_role  = CONFIG_PATH . 'menu/main.role.'  . $_SESSION['mapc_user_role']  . '.php';
        $menu_core  = CONFIG_PATH . 'menu/main.core.php';

    }

} // BLOCK

{ // BLOCK:include_menu:20151012

    $menu = array();

    // 개인별 메뉴
    if(is_file($menu_user)) {
        $menu += include($menu_user);
    }
    // 권한별 메뉴
    elseif(is_file($menu_role)) {
        $menu += include($menu_role);
    }
    // 그룹별 메뉴
    elseif(is_file($menu_group)) {
        $menu += include($menu_group);
    }
    // 기본메뉴
    elseif(is_file($menu_core)) {
        $menu += include($menu_core);
    }

    return $menu;

} // BLOCK

// end of file
