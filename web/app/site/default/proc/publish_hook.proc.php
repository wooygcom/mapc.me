<?phpif(!defined('__MAPC__')) { exit(); }{ // BLOCK:module_config:20130102:필요한 모듈의 환경설정 불러오기, include required module config	// 메뉴 모듈	include_once(MODULE_PATH . 'menu/config/config.php');	// 사용자 모듈	include_once(MODULE_PATH . 'user/config/config.php');	// MAPC 모듈	include_once(MODULE_PATH . 'mapc/config/config.php');} // BLOCK{ // BLOCK:menu_get:20121228:get menu array and convert to <li> type	include_once($PATH['menu']['root'] . 'model/menu_convert.func.php');	include_once($PATH['menu']['data'] . 'default/' . 'menu.main.php');	include_once($PATH['menu']['data'] . 'default/' . 'menu_title.' . $CONFIG['lang'] . '.php');	$menu	= $MENU['sitemap'];	$option	= array(		'submenu'	=> FALSE,		'menu_class'=> 'nav navbar-nav',		'page_current'	=> 'home'	);	$publish_data['head']['menu']	= module_menu_convert($menu, $option);	$menu	= $MENU['sitemap']['mapc'];	$option	= array(		'submenu'	=> TRUE,		'menu_class'=> 'nav nav-list',		'page_current'	=> 'mapc',		'title'		=> 'MAPC'	);	$publish_data['head']['menu_sub']	= module_menu_convert($menu, $option);} // BLOCK$publish_data['head']['title']					= $CONFIG['title'];$publish_data['head']['js']['jquery.min.js']	= $URL['core']['root'] . 'res/jquery/';$publish_data['head']['js']['bootstrap.min.js']	= $URL['core']['root'] . 'res/bootstrap/js/';$publish_data['head']['css']['bootstrap.min.css']	= $URL['core']['root'] . 'res/bootstrap/css/';// end of file