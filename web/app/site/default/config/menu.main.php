<?php
	if(!defined('__MAPC__')) { exit(); }

	$MENU = isset($MENU) ? $MENU : array();

	$MENU['_default_submenu'] = 'mainmenu1';

    $MENU['sitemap']['mainmenu1']['_title']  = '메인메뉴1';
    $MENU['sitemap']['mainmenu1']['_link']   = '';
    $MENU['sitemap']['mainmenu1']['_key']    = 'mainmenu1';
    $MENU['sitemap']['mainmenu1']['_sub']['menu1']['_title'] = '메뉴1';
    $MENU['sitemap']['mainmenu1']['_sub']['menu1']['_link']  = '#';
    $MENU['sitemap']['mainmenu1']['_sub']['menu2']['_title'] = '메뉴2';
    $MENU['sitemap']['mainmenu1']['_sub']['menu2']['_link']  = '#';
    $MENU['sitemap']['mainmenu1']['_sub']['menu3']['_title'] = '메뉴3';
    $MENU['sitemap']['mainmenu1']['_sub']['menu3']['_link']  = '#';

    $MENU['sitemap']['mainmenu2']['_title']  = '메인메뉴2';
    $MENU['sitemap']['mainmenu2']['_link']   = '';
    $MENU['sitemap']['mainmenu2']['_key']    = 'mainmenu2';
    $MENU['sitemap']['mainmenu2']['_sub']['menu1']['_title'] = '메뉴1';
    $MENU['sitemap']['mainmenu2']['_sub']['menu1']['_link']  = '#';
    $MENU['sitemap']['mainmenu2']['_sub']['menu2']['_title'] = '메뉴2';
    $MENU['sitemap']['mainmenu2']['_sub']['menu2']['_link']  = '#';

    // #TODO 관리자 메뉴 링크 추가하기!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    $MENU['admin']['main']['_title'] = '관리';
    $MENU['admin']['main']['_link']  = '#';

    $MENU['admin']['user']['_title'] = '사용자';
    $MENU['admin']['user']['_link']  = '#';
    $MENU['admin']['user']['_sub']['_title'] = '사용자리스트';
    $MENU['admin']['user']['_sub']['_link']  = '#';


// this is it
