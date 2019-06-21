<?php
	$mapcArgs = explode("/", $_REQUEST['_url']);

// #TODO phacon의 ROUTE->add 함수 또는 Laravel의 ROUTE::post('/uri', '/callback') 같은 클래스를 만들어야 됨
	$routes['vendor'] = $mapcArgs[1] ? $mapcArgs[1] : DEFAULT_VENDOR;

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
		case 'common':
		case 'ext':
		case 'smu':
		case 'beta':

			$routes = include(APP_PATH . $routes['vendor'] . '/config/routes.php');
			break;

		default:

			$routes['module'] = $mapcArgs[2];
			$routes['id']     = $mapcArgs[3];
			$routes['action'] = $mapcArgs[4];
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

			} elseif(empty($routes['id'])) {

				$routes['callback'] = $routes['module'] . '/index';

			} elseif( $routes['id'] == 'new' ) {

				$routes['callback'] = $routes['module'] . '/edit';

			} elseif(! empty($routes['action']) ) {

				$routes['callback'] = $routes['module'] . '/' . $routes['action'];

			} else {

				$routes['callback'] = $routes['module'] . '/detail';

			}

			break;

	}

	return $routes;

// this is it
