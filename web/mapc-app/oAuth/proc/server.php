<?php
if(!defined("__MAPC__")) { exit(); }

include VENDOR_PATH . 'autoload.php';

$dsn      = $CONFIG['dbadapter'] . ':dbname=' . $CONFIG['dbname'] . ';host=' . $CONFIG['dbhost'];
$username = $CONFIG['dbuser'];
$password = $CONFIG['dbpass'];

// Autoloading (composer is preferred, but for this example let's just do this)
OAuth2\Autoloader::register();

// $dsn is the Data Source Name for your database, for exmaple "mysql:dbname=my_oauth2_db;host=localhost"
$storage = new OAuth2\Storage\Pdo(array('dsn' => $dsn, 'username' => $username, 'password' => $password));

// Pass a storage object or array of storage objects to the OAuth2 server class
$server = new OAuth2\Server($storage);

// Add the "Client Credentials" grant type (it is the simplest of the grant types)
$server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));

// Add the "Authorization Code" grant type (this is where the oauth magic happens)
$server->addGrantType(new OAuth2\GrantType\AuthorizationCode($storage));

// e:\temp\curl\bin\curl.exe -u testclient:testpass http://[IPADDRESS]/web/mapc-public/oAuth -d "grant_type=client_credentials"

// this is it
