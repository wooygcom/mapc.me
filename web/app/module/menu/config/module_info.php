<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 모듈 설치에 필요한 정보
 *
 * 'req'  이 모듈을 설치하기 위해 필요한 상위모듈
 *     ie. $CFG_MODL['bbs']['req'] = 'auth';
 * 'ver'  버전
 *     ie. $CFG_MODL['bbs']['ver'] = '0.0.1';
 * 'path' 프로그램이 설치된 디렉토리 
 * 'menu' 메뉴, 이 모듈을 설치하면 사용할 수 있는 모듈들의 접근URL
 */

// 이 모듈을 사용하기 위해 필요한 상위모듈
$MODULE['menu']['req'][] = '';

// 모듈버전
$MODULE['menu']['ver'] = '0.0.1';

// end of file
