<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 일반적인 페이지에서 include하는 초기화 꼬리화일
 */

// 템플릿 출력에는 불필요한 환경설정 변수 삭제
unset($CONFIG_SECRET);

// this is it
