<?php
namespace Mapc\oAuth;

use Mapc\Common\Crud;
use Mapc\oAuth\oAuthLogin;
use OAuth2\Autoloader;
use OAuth2\GrantType\ClientCredentials;
use OAuth2\GrantType\UserCredentials;
use OAuth2\Server;
use OAuth2\Storage\Pdo;
use OAuth2\GrantType\AuthorizationCode;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\GenericProvider;
use \RedBeanPHP\R;

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

    /**
     * @return Server
     */
    public function setConfig() {
        $dsn = 'mysql:dbname=mysql;host=localhost';
        $username = 'root';
        $password = 'root';
        //ini_set('display_errors', 1);
        //error_reporting(E_ALL);

        Autoloader::register();
        //$storage = new Pdo(array('dsn' => $dsn, 'username' => $username, 'password' => $password));
        //$server = new Server($storage);
        //$server->addGrantType(new ClientCredentials($storage));
        //$server->addGrantType(new AuthorizationCode($storage));

        try{
            // $dsn is the Data Source Name for your database, for exmaple "mysql:dbname=my_oauth2_db;host=localhost"
            $storage = new oAuthLogin(array('dsn' => $dsn, 'username' => $username, 'password' => $password));

            // Pass a storage object or array of storage objects to the OAuth2 server class
            $server = new Server($storage);

            // Add the "User Credentials" grant type
            $server->addGrantType(new UserCredentials($storage));
            $server->addGrantType(new AuthorizationCode($storage));

        }catch(\PDOException $e){
            // DO NOT send the password to the log files.
            echo str_replace($password, ' *** Password Removed *** ' , $e);
            die;
        }


        return $server;
    }

    public function getUserInfos($client_id = NULL) {
        if (empty($client_id)) {
            return false;
        }

        $dsn = 'mysql:dbname=mysql;host=localhost';
        $username = 'root';
        $password = 'root';

        Autoloader::register();
        $storage = new oAuthUser(array('dsn' => $dsn, 'username' => $username, 'password' => $password));
        $user_details = $storage->getUserDetails($client_id);

        return $user_details;
    }

    public function logout() {
        $dsn = 'mysql:dbname=mysql;host=localhost';
        $username = 'root';
        $password = 'root';

        Autoloader::register();

        $access_token = $_SESSION['access_token'];

        $storage = new oAuthUser(array('dsn' => $dsn, 'username' => $username, 'password' => $password));
        $result = $storage->unsetAccessToken($access_token);

        if ($result == true) {
            session_destroy();
            return true;
        }
    }

} // class

// this is it
