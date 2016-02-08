<?php
namespace Mapc\Module\Paging;

if(!defined('__MAPC__')) { exit(); }

/**
 * 페이징 함수
 *
 * @param  str $arg['total'] 전체 row수
 * @param  str $arg['url']   연결하려는 곳 주소~
 * @param  str $arg['page']  현재 페이지
 * @param  str $arg['page_key']  페이지 번호를 받는 변수명
 * @param  str $arg['curr']  현재 글번호(선택)
 * @param  str $arg['pageSet'] 한페이지에 출력할 글 수 (선택)
 * @param  str $arg['blockSet'] 한번에 출력할 페이지수 (선택)(5로 하면 -> prev 1.2.3.4.5 next)
 *
 * @return str   $url   연결하려는 주소~
 * @return int   $prev  이전 페이지
 * @return int   $page  현재 페이지
 * @return int   $next  다음페이지
 * @return int   $first 시작할 때의 글번호
 * @return str   $pageKey &pageNumber=1 <- 이 경우에는 $pageKey = 'pageNumber'
 * @return array $range prev 5.6.7.8.9 next <- 이 경우에 array(5,6,7,8,9)
 */
function pagingGen($arg = []) {

	extract($arg);

	// 현재페이지 (없으면 1)
	$page		= $page     ? $page     :  1;
	// 한 페이지에 출력하는 row수
	$pageSet	= $pageSet  ? $pageSet  : 20;
	// 한 페이지에 화면에 출력하는 페이지수 ([prev] 1.2.3.4.5 [next] <- 이 때는 blockSet '5')
	$blockSet	= $blockSet ? $blockSet :  5;

	// $current(현재글번호)가 있을 경우 $current값을 가지고 몇번째 페이지인지 알아내기 (공식 : floor(($curr - 1) / $pageSet) * $pageSet)
	$page = $current ? floor(($current - 1) / $pageSet) : $page;

	// 전체 페이지 수
	$pages = ceil($total / $pageSet);

	// 현재페이지에서의 첫글번호, 끝글번호
	$begin_page = $blockSet * ($page - 1);
	$end_page   = $blockSet *  $page;

	// 출력될 때의 글번호 10,9,8,7... <- 여기서 first는 '10'
	$first = $total - ($pageSet * ($page - 1));

	// 첫번째블럭번호, 마지막블럭번호 (5,6,7,8,9 <- 여기서 $begin=5, $end=9)
	$begin = floor(($page-1) / $blockSet) * $blockSet;
	$end   = $begin + $blockSet;
    $begin++;

	// 블럭내 끝  record($end)가 전체값($total)을 넘을 수 없으므로...
	if($end > $pages) { $end = $pages; }
	if($end == 0)     { $end = 1; }

	// prev 5.6.7.8.9 next - 이 경우에 array(5,6,7,8,9)
	$range = range($begin, $end);

	// prev(이전페이지)출력 - $page가 1이 아닐 때
	if($begin != 1)
		{ $prev = $begin - 1; }
	// next(다음페이지)출력 - $page가 $end가 아닐 때
	if($end != $pages && $end != 1)
		{ $next = $end + 1; }

	$return = compact('page', 'pageKey', 'first', 'prev', 'next', 'range', 'url');

	return $return;

} // function

// end of file
