<?php
	if(!defined('__MAPC__')) { exit(); }

	/**
	 * 메뉴변환
	 *
	 * array를 li로 변환
	 *
	 * @param string	$option['title']		- 메뉴의 제목(출력을 원할 경우 입력(주로 서브메뉴에서 사용함)
	 * @param string	$option['page_current']	- 현재페이지의 고유값, unique ID of current page
	 * @param string	$option['menu_class']	- ul로 출력할 경우 ul의 class 이름
	 * @param boolean	$option['submenu']		- submenu 출력여부... TRUE, FALSE
	 */
	// #TODO 이미 cache파일로 만들었을 경우 그 파일을 그대로 include (ie. module_menu_convert($menu, $option('page_current' => 'userid_iwp2', 'display' => 'ul')));
	// #TODO cache파일로 만들 경우 $style['page_current'] = 'active'; <li $style['intro']>INTRO</li>

	function module_menu_convert($menu = array(), $option = array()) {

		switch($menu['_type']) {

			// $
			case 'html':
				return $menu['_content'];

				break;

			default:
				$option['first'] = true;

				$return = '<ul class="'.$option['menu_class'].'">'
						. $title
						. module_menu_convert_sub($menu, $option)
						. '</ul>';

				return $return;

				break;

		}

	}

	function module_menu_convert_sub($param = array(), $option = array()) {

		$recursion = __FUNCTION__;
		$return = '';

		if( ! is_array($param) ) {

			return '';

		}

		// 현재 페이지 일 경우, current_page = TRUE
		if($param['_key'] == $option['page_current']) {

			$current_page = true;
			$style = ' class="active" ';

		}

		// _title이 지정되어있지 않은 array가 들어왔을 경우 하위 배열만 검사
		if(empty($param['_title'])) {

			foreach($param as $key => $var) {

				$return .= $recursion($var, $option);

			}

		// _title, _link이외의 값들(서브메뉴)가 있을 경우 && submenu option이 TRUE일 경우(서브메뉴 출력할 경우)
		} elseif(count($param) > 2 && $option['submenu']) {

			if($option['first'] && ( ! empty($param['_title'])) ) {

				$style = ' class="dropdown" ';
				$option['first'] = false;

                if($option['dropdown']) {
                    $return .= '<li ' . $style . '><a href="#dummy" class="dropdown-toggle" data-toggle="dropdown">' . $param['_title'] . '</a>';
                    $return .= '<ul class="dropdown-menu">' . "\n";
                } else {
                    $return .= '<li ' . $style . '>' . $param['_title'] . '<ul>';
                }

			} else {

				$return .= '<li ' . $style . '><a href="' . $param['_link'] . '">' . $param['_title'] . '</a>' . "\n";
				$return .= '<ul>' . "\n";

			}

			foreach($param as $key => $var) {

				$return .= $recursion($var, $option);

			}

			$return .= '</ul>'."\n";
			$return .= '</li>'."\n";

		} else {

			$return = '<li ' . $style . '><a href="'.$param['_link'].'">'.$param['_title'].'</a></li>'."\n";

		}

		return $return;

	}

// end of file
