<?php
	if(!defined('__MAPC__')) { exit(); }

    /**
     * 특정 디렉토리의 리스트 출력
	 *
	 * @param string $dir 화일 리스트를 가져올 디렉토리
	 * @param bool   $option['show_sub'] 서브디렉토리 전부를 가져올지에 대한 옵션
     */
    function mapc_dir_list($dir, $option = array()) {

		$root = scandir($dir);

		foreach($root as $value)
		{
			if($value === '.' || $value === '..') {continue;}
			if(is_file("$dir/$value")) {$result[]="$dir/$value";continue;}
			if($option['show_sub'] == TRUE) {
				foreach(mapc_dir_list("$dir/$value") as $value)
				{
					$result[]=$value;
				}
			}
		}

		return $result;
    
    }
// this is it
