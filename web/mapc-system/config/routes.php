<?php
	$mapcArgs = explode("/", $_REQUEST['_url']);

	$routes = [];

// #TODO phacon의 ROUTE->add 함수 또는 Laravel의 ROUTE::post('/uri', '/callback') 같은 클래스를 만들어야 됨
	$routes['vendor'] = $mapcArgs[1] ? $mapcArgs[1] : DEFAULT_VENDOR;
	$routes['module'] = $mapcArgs[2] ? $mapcArgs[2] : DEFAULT_MODULE;

	switch($routes['vendor']) {

		/**
		 *
		 * 특수한 경우에만 Route {Vendor}/config/routes.php 에서 설정을 따로 함
		 *
		 */
		/*
			GET	/contents
			GET	/contents/new
			POST	/contents
			GET	/contents/:id
			GET	/contents/:id/edit
			PUT	/contents/:id
			DELETE	/contents/:id
		*/
		/*
		case 'VENDOR':
			$routes = include(APP_PATH . $routes['vendor'] . '/config/routes.php');
			break;
		*/
		// 각각의 디렉토리의 routes설정을 가져오도록... common/config/routes.php
		case 'common':
		case 'ext':

			$routes = include(APP_PATH . $routes['vendor'] . '/config/routes.php');
			break;

		case 'crud':

			$routes['id']     = $mapcArgs[3];
			$routes['action'] = $mapcArgs[4] ? $mapcArgs[4] : DEFAULT_ACTION;
			$routes['args']   = array_slice($mapcArgs, 4);

			// #TODO URI 자동 인식하게끔 /
			if($_SERVER['REQUEST_METHOD'] == 'POST') {

				// POST값이 들어오면 "실행"
			    switch($_POST['_method']) {
			        case 'post':
			        case 'put':
			        case 'patch':
			        case 'delete':
			       	default:
			        	$routes['callback'] = $routes['module'] . '/exec';
			            break;
			    }

			} elseif(empty($routes['id']) || $routes['id'] == 'a') {

				$routes['callback'] = $routes['module'] . '/list';

			} elseif( $routes['id'] == 'new' ) {

				$routes['callback'] = $routes['module'] . '/edit';

			} else {

				// 페이지 표시(POST값이 없을 경우)
				switch($routes['action']) {
					case 'edit':
						$routes['callback'] = $routes['module'] . '/edit';
						break;
					case 'detail':
					default:
						$routes['callback'] = $routes['module'] . '/detail';
						break;
				}

			}

			break;

		default:
			$routes['action'] = $mapcArgs[3] ? $mapcArgs[3] : DEFAULT_ACTION;
			$routes['option'] = $mapcArgs[4];
			$routes['args']   = array_slice($mapcArgs, 5);


			if($_SERVER['REQUEST_METHOD'] == 'POST') {

				// POST값이 들어오면 "실행"
			    switch($_POST['_method']) {
			        case 'post':
			        case 'put':
			        case 'patch':
			        case 'delete':
			       	default:
			        	$routes['callback'] = $routes['module'] . '/exec';
			            break;
			    }

			} else {

				$routes['callback'] = $routes['module'] . '/' . $routes['action'];

			}
			break;

	}

	return $routes;

// this is it
