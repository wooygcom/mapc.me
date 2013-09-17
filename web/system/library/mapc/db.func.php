<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * DB 연결
 *
 * @para string $dbinfo['type']
 * @para string $dbinfo['host']
 * @para string $dbinfo['name']
 * @para string $dbinfo['user']
 * @para string $dbinfo['pass']
 * @para string $dbinfo['encode']
 */
function mapc_db_connect($dbinfo = array()) {

	try {

		$dsn = $dbinfo['type'].':host='.$dbinfo['host'].';dbname='.$dbinfo['name'];

		$dbh = new PDO(
			  $dsn
			, $dbinfo['user']
			, $dbinfo['pass']
			, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES '.$dbinfo['encode'])
			);

	} catch (PDOException $e) {

		print "Error!: " . $e->getMessage();
		die();

	}

	return $dbh;

}

// this is it
