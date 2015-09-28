<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 회원 리스트
 */

require(INIT_PATH . 'init.auth.php');
{ // Model : Head

	{ // BLOCK:SEARCH:20131101:검색조건 만들기

		$search_key = $_REQUEST['user_search_key'];
		$search_var = $_REQUEST['user_search_var'];
		$is_search  = $_REQUEST['user_search_var'] ? true : false;

	} // BLOCK

	{ // BLOCK:list_get:20131101:리스트 가져오기

		$query = "
			SELECT `user_seq`, `user_uid`, `user_name`, `user_id`, `user_type`, `user_email`, `user_sign_up_date`, `user_sign_in_date_latest`, `user_status`, `user_etc`
			  FROM " . $CONFIG_DB['prefix'] . "user_info
			" . $search . "
			 ORDER BY user_sign_up_date
			  DESC LIMIT :page, :pageSet
			";

		$sth       = $CONFIG_DB['handler']->prepare($query);
		$user_page = $_REQUEST['user_page'] ? (int)$_REQUEST['user_page'] : 1;
		$page      = ($user_page - 1) * 10;
		$pageSet   = 10;

		$sth->bindParam(':page',    $page,    PDO::PARAM_INT);
		$sth->bindParam(':pageSet', $pageSet, PDO::PARAM_INT);
		if($is_search) {
			$sth->bindParam(':search_key', $search_key);
			$sth->bindParam(':search_var', $search_var);
		}
		$sth->execute();

		while($result = $sth->fetch(PDO::FETCH_ASSOC)) {

			$post_list[] = $result;

		}

	} // BLOCK

	{ // BLOCK:paging:20131028:페이징 출력

		include_once(MODULE_PATH . 'paging/config/config.php');
		include_once(MODULE_PATH . 'paging/model/paging_gen.func.php');

		$arg['total'] = $CONFIG_DB['handler']->query('SELECT FOUND_ROWS();')->fetch(PDO::FETCH_COLUMN);

		$arg['page']    = $mapc_page ? $mapc_page : 1;
		$arg['pageSet'] = $pageSet;
		$arg['url']     = $URL_ADMIN['user']['list'];

		$paging = module_paging_gen($arg);

		$TPL_DATA['paging']['file'] = $PATH['paging']['root'] . 'view/basic/paging.tpl.php';
		$TPL_DATA['paging']['data'] = $paging;

	} // BLOCK

} // Model : Tail

// ======================================================================

{ // View : Head

	{ // BLOCK:echo_view:20130923:화면출력

		$section_file = $PATH_ADMIN['user']['root'] . 'view/basic/group.view.php';
		include_once(PROC_PATH . 'publish.proc.php');

	}

} // View : Tail

// end of file
