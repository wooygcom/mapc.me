<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 특정 디렉토리의 리스트 출력
 *
 * @param string $dir 화일 리스트를 가져올 디렉토리
 * @param int    $option['count'] 이 재귀 함수가 몇번 호출되었는지...(자동지정)
 * @param string $option['base_dir'] 디렉토리 리스트의 최고ROOT디렉토리 (최초의 $dir값이 "data/abc/"였다고 하면 "data/abc/"가 base_dir)(자동지정)
 *
 * @param bool   $option['show_base'] base_dir 포함해서 출력할지(true) 아니면 포함안하고 출력할지(false)
 * @param bool   $option['show_sub'] 서브디렉토리 전부를 가져올지에 대한 옵션
 * @param bool   $option['hide_file'] 화일 출력할 지 여부 true:file리스트를 포함한 값 반환, false:디렉토리 리스트만 리턴
 * @param bool   $option['hide_dir']  디렉토리 출력할 지 여부
 * @param string $option['ext_inc']	해당 확장자의 파일만의 리스트
 * @param string $option['ext_exp'] 해당 확장자의 파일만 제외한 리스트
 */
function mapc_dir_list($dir, $option = array()) {

	$dir = str_replace('//', '/', $dir);

	$root = scandir($dir);

	if(empty($option['count']) || $option['count'] == 0) {
		$option['base_dir'] = $dir;
	}

	$option['count']++;

	foreach($root as $value)
	{

		if($value === '.' || $value === '..') {

			continue;

		}

		// 화일 숨기기 옵션이면 화일은 출력안하고 통과
		if(is_file("$dir/$value") && ! $option['hide_file']) {

			$pass_file = false;

			if(isset($option['ext_inc'])) {

				$ext = substr($value, -1 * strlen($option['ext_inc']));
				if(strtolower($ext) != strtolower($option['ext_inc'])) {
					$pass_file = true;
				}

			}

			if(isset($option['ext_exp'])) {

				$ext = substr($value, -1 * strlen($option['ext_exp']));

				if(strtolower($ext) == strtolower($option['ext_exp'])) {
					$pass_file = true;
				}

			}

			if(!$pass_file) {
				if(! empty($dir)) { $add = $dir; }
				if(! $option['show_base']) {
					$add = str_replace($option['base_dir'], '', $add);
				}
				$result[] = $add . $value;continue;
				$add = '';
			} else {
				continue;
			}

		// 디렉토리 숨기기 옵션이면 디렉토리는 출력안하고 통과
		} elseif(is_dir("$dir/$value") && ! $option['hide_dir']) {

			if(! $option['show_base']) {
				$dir_temp = str_replace($option['base_dir'], '', $dir);
			} else {
				$dir_temp = $dir;
			}

			$result[] = $dir_temp . $value . '/';

		}


		if($option['show_sub'] == true && is_dir($dir . '/' . $value)) {

			$dir_arr = mapc_dir_list($dir . $value . '/', $option);

			if(is_array($dir_arr)) {

				foreach($dir_arr as $value)
				{

					$result[]=$value;

				}

			}

		}

	}

	return $result;

}

// this is it
