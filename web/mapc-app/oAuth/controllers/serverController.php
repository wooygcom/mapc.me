<?php

include_once PROC_PATH . 'proc.autoload.php';
@include($ROUTES['callback'] . '.php');

// this is it


$code = $_GET['code'];
$state = $_GET['state'];

// 임시 database connect
$conn = mysqli_connect(
    'localhost',
    'root',
    'root',
    'mysql'
);
$sql = "SELECT * FROM oauth_authorization_codes WHERE authorization_code = '" . $code . "'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$client_id = $row["client_id"];

$sql = "SELECT * FROM oauth_clients WHERE client_id = '" . $client_id . "'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$client_secret = $row["client_secret"];

// $ curl -u TestClient:TestSecret https://api.mysite.com/token -d 'grant_type=authorization_code&code=xyz'
$ch = curl_init();
curl_setopt($ch, CURLOPT_USERPWD, "$client_id:$client_secret");
curl_setopt($ch, CURLOPT_URL, "http://localhost/web/mapc-public/oAuth/token");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, array(
    'code' => $code,
    'grant_type' => 'authorization_code',
    'redirect_uri' => 'http://localhost/web/mapc-public/oAuth/server'
));

$data = curl_exec($ch);

var_dump($data);
die();

//OAuth2\Request::createFromGlobals();

//$ curl -u testclient:testpass http://localhost/token.php -d 'grant_type=authorization_code&code=097e3c941d91a84861fef771c025cbb365dff010'
//{"access_token":"1bde0a7785f78eaddcd3e4555ca382e884d9ad4f","expires_in":3600,"token_type":"Bearer","scope":null,"refresh_token":"c8d988fdcf8707f5e8f728a86aa0e49d3109b9b0"}


