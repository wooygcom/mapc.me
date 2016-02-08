<?php
	if(!defined('__MAPC__')) { exit(); }

	/**
	 * 입력값 체크
	 *
	 * 해킹코드 검사 및 변환
     *
     * @param array  $data 원본 자료
     * @param string $level 변환시키려는급 (strict, normal...)
	 */

	function mapc_common_check_var($data, $level = 'normal') {

        if(is_array($data)) {
            foreach($data as $key => $var) {

                // 레벨별로 안전한 코드로 변환 : 중간에 break 문을 사용하지 않음(각 레벨별로 적용시켜야 되는 함수가 중첩되기 때문)
                switch($level) {
                    case 'strict':
                        $var = str_replace(array('<','>'), array('[',']'), $var);
                    case 'normal':
                        break;
                }

                $data[$key] = $var;

            }
        }

		return $data;

	}

// this is it
