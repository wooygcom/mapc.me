<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 특정 디렉토리의 리스트 출력
 *
 * @param string $dir 화일 리스트를 가져올 디렉토리
 * @param bool   $option['show_sub'] 서브디렉토리 전부를 가져올지에 대한 옵션
 * @param string $option['ext_inc']	해당 확장자의 파일만의 리스트
 * @param string $option['ext_exp'] 해당 확장자의 파일만 제외한 리스트
 */
function mapc_dir_list($dir, $option = array()) {

	$root = scandir($dir);

	foreach($root as $value)
	{

		if($value === '.' || $value === '..') {

			continue;

		}
		if(is_file("$dir/$value")) {

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
				if(!empty($dir)) { $add = $dir . '/'; }
				$result[] = $add . $value;continue;
				$add = '';
			} else {
				continue;
			}

		}

		if($option['show_sub'] == true) {

			$dir_arr = mapc_dir_list("$dir/$value", $option);

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
