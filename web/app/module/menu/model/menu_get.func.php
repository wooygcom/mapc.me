<?php
/**
 * return menu info
 *
 * @param string $option['menu_class'] 활성화 된 메뉴의 class name, Class name of active menu
 */
if(!defined('__MAPC__')) { exit(); }

function mapc_menu_get($menu, $option) {

	$option	= array(
		'menu_class'=> 'nav',
		'submenu'	=> FALSE,
		'page_current'	=> 'home'
	);

	$result	= pfw_menu_convert($menu, $option);

	return $result;

} // BLOCK

// this is it
