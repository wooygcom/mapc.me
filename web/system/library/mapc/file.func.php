<?php
	if(!defined('__MAPC__')) { exit(); }

	/**
	 * 화일 내용 메모리에 넣기
	 *
	 * @param str $filename 가져오려는 화일
	 * @param str $data     출력하려는 내용
	 * @param str $display  출력할지(display), 버퍼에 넣을지(burfer)
	 *
	 * 사용예 :
	 *     $filename    = '/skin/list.tpl.php';
	 *     $data['url'] = 'index.php?id=298';
	 *     $contents    = pfw_file_get_contents($filename, $data, 'buffer');
	 */
	function mapc_file_get_contents($filename, &$data = array())
	{

		extract($data);

		@ob_start();

		include($filename);
		$buffer = @ob_get_contents();
		@ob_end_clean();

		return $buffer;

	}

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
