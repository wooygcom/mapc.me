<?php
	/**
	 *
	 * Routes config for {Vendor}
	 *
	 */

switch ($routes['module']) {

	case 'users':

		$routes['action'] = $mapcArgs[3] ? $mapcArgs[3] : DEFAULT_ACTION;
		$routes['option'] = $mapcArgs[4];
		$routes['args']   = array_slice($mapcArgs, 5);

		// POST값이 들어오면 "실행"
		if($_SERVER['REQUEST_METHOD'] == 'POST') {

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

	default:

		$routes['module'] = $mapcArgs[2] ? $mapcArgs[2] : DEFAULT_MODULE;
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

		} elseif(empty($routes['id'])) {

			$routes['callback'] = $routes['module'] . '/list';

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
