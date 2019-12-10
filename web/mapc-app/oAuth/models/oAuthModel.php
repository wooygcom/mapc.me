<?php
namespace Mapc\oAuth;

use Mapc\Common\Crud;
use OAuth2\Autoloader;
use OAuth2\GrantType\ClientCredentials;
use OAuth2\Server;
use OAuth2\Storage\Pdo;
use OAuth2\GrantType\AuthorizationCode;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\GenericProvider;

/**
 * Item Model
 * @version 0.1
 */
class oAuth extends Crud {

    public function getUrl(){
        $url = "http://localhost/web/mapc-public/";
        return $url;
    }

    public function clientInfo($postArr = []){
        $url = "http://localhost/web/mapc-public/";
        $clientId = 'testclient';
        $clientSecret = 'testpass';
        $clientInfo = [
            'clientId'  => $clientId,
            'clientSecret'  => $clientSecret,
            'redirectUri'   => $url
        ];
        if(isset($postArr['user_email']) && $postArr['user_email']){
            $clientInfo['clientId'] = $postArr['user_email'];
        }
        if(isset($postArr['user_password']) && $postArr['user_password']){
            $clientInfo['clientSecret'] = $postArr['user_password'];
        }
        if(isset($postArr['redirect_uri']) && $postArr['redirect_uri']){
            $clientInfo['redirectUri'] = $postArr['redirect_uri'];
        }
        return $clientInfo;
    }

    public function clientInfoByCode($code = NULL) {
        if (empty($code)) {
            return false;
        }

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
        $redirect_uri = $row["redirect_uri"];

        $clientInfo = [
            'clientId'  => $client_id,
            'clientSecret'  => $client_secret,
            'redirectUri'   => $redirect_uri
        ];

        return $clientInfo;
    }

    public function setConfig() {
        $dsn = 'mysql:dbname=mysql;host=localhost';
        $username = 'root';
        $password = 'root';
        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        Autoloader::register();
        $storage = new Pdo(array('dsn' => $dsn, 'username' => $username, 'password' => $password));
        $server = new Server($storage);
        $server->addGrantType(new ClientCredentials($storage));
        $server->addGrantType(new AuthorizationCode($storage));
        return $server;
    }

    public function getUserInfos($access_token = NULL) {
        if (empty($access_token)) {
            return false;
        }

    }

    public function logout() {
        $conn = mysqli_connect(
            'localhost',
            'root',
            'root',
            'mysql'
        );

        session_start();

        // DELETE FROM 테이블이름 WHERE 필드이름=데이터값
        $access_token = $_SESSION['access_token'];
        $delete_query = "DELETE FROM oauth_access_tokens WHERE access_token = '" . $access_token . "'";

        $result = mysqli_query($conn,$delete_query);
        if ($result == true) {
            session_destroy();
            return true;
        }

        mysqli_close($conn);

        return false;
    }

} // class

// this is it
