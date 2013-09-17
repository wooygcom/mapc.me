<?php
	if(!defined('__MAPC__')) { exit(); }

	$MENU = isset($MENU) ? $MENU : array();

    $MENU['sitemap']['mapc']['_title']  = '맵시';
    $MENU['sitemap']['mapc']['_link']   = '';
    $MENU['sitemap']['mapc']['_key']    = 'mapc';
    $MENU['sitemap']['mapc']['_sub']['view']['_title'] = '글보기';
    $MENU['sitemap']['mapc']['_sub']['view']['_link']  = $URL['mapc']['view'];
    $MENU['sitemap']['mapc']['_sub']['edit']['_title'] = '글쓰기/편집';
    $MENU['sitemap']['mapc']['_sub']['edit']['_link']  = $URL['mapc']['edit'];
    $MENU['sitemap']['mapc']['_sub']['list']['_title'] = '리스트';
    $MENU['sitemap']['mapc']['_sub']['list']['_link']  = $URL['mapc']['list'];
    $MENU['sitemap']['mapc']['_sub']['list']['_sub'][0]['_title'] = '주제별';
    $MENU['sitemap']['mapc']['_sub']['list']['_sub'][0]['_link']  = $URL['mapc']['list'].'&mapc_cate=subject';
    $MENU['sitemap']['mapc']['_sub']['list']['_sub'][1]['_title'] = '형식별';
    $MENU['sitemap']['mapc']['_sub']['list']['_sub'][1]['_link']  = $URL['mapc']['list'].'&mapc_cate=format';
    $MENU['sitemap']['mapc']['_sub']['list']['_sub'][2]['_title'] = '유형별';
    $MENU['sitemap']['mapc']['_sub']['list']['_sub'][2]['_link']  = $URL['mapc']['list'].'&mapc_cate=type';
    $MENU['sitemap']['mapc']['_sub']['list']['_sub'][3]['_title'] = '날짜별';
    $MENU['sitemap']['mapc']['_sub']['list']['_sub'][3]['_link']  = $URL['mapc']['list'].'&mapc_cate=date';
    $MENU['sitemap']['mapc']['_sub']['list']['_sub'][4]['_title'] = '범위별';
    $MENU['sitemap']['mapc']['_sub']['list']['_sub'][4]['_link']  = $URL['mapc']['list'].'&mapc_cate=coverage';

	if($DEBUG) {

		$MENU['sitemap']['user']['_title']	= 'User';
		// user	-> sign in, sign out, sign up
		// chat	-> chat list, input chat
		// mapc	-> list (include search, sort by name, title, date, format, subject, etc...), write, edit, delete
		$MENU['sitemap']['comm']['_title'] = '커뮤니티';
		$MENU['sitemap']['comm']['_link']  = $URL['content']['community'];
		$MENU['sitemap']['comm'][0]['_title'] = '공지사항';
		$MENU['sitemap']['comm'][0]['_link']  = $URL['bbs']['list'].'&tid=notice';
		$MENU['sitemap']['comm'][1]['_title'] = '자유게시판';
		$MENU['sitemap']['comm'][1]['_link']  = $URL['bbs']['list'].'&tid=free';

		$MENU['sitemap']['user4out']['_title'] = '회원메뉴';
		$MENU['sitemap']['user4out']['_link']  = $URL['auth']['join'];
		$MENU['sitemap']['user4out'][0]['_title'] = '회원가입';
		$MENU['sitemap']['user4out'][0]['_link']  = $URL['auth']['join'];
		$MENU['sitemap']['user4out'][1]['_title'] = '로그인';
		$MENU['sitemap']['user4out'][1]['_link']  = $URL['auth']['signin'];

		$MENU['sitemap']['user4in']['_title'] = '회원정보';
		$MENU['sitemap']['user4in']['_link']  = $URL['auth']['edit'];
		$MENU['sitemap']['user4in'][0]['_title'] = '회원정보';
		$MENU['sitemap']['user4in'][0]['_link']  = $URL['auth']['edit'];
		$MENU['sitemap']['user4in'][1]['_title'] = '쪽지 보내기';
		$MENU['sitemap']['user4in'][1]['_link']  = $URL['auth']['memo_send'];
		$MENU['sitemap']['user4in'][2]['_title'] = '쪽지 확인';
		$MENU['sitemap']['user4in'][2]['_link']  = $URL['auth']['memo_view'];
		$MENU['sitemap']['user4in'][3]['_title'] = '쪽지 리스트';
		$MENU['sitemap']['user4in'][3]['_link']  = $URL['auth']['memo_list'];
		$MENU['sitemap']['user4in'][4]['_title'] = '보낸 쪽지';
		$MENU['sitemap']['user4in'][4]['_link']  = $URL['auth']['memo_list_send'];
		$MENU['sitemap']['user4in'][5]['_title'] = '받은 쪽지';
		$MENU['sitemap']['user4in'][5]['_link']  = $URL['auth']['memo_list_recv'];

	}

// this is it
