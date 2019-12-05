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
            'redirectUri'   => $url . 'oAuth/server'
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

    public function setConfig()
    {

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

} // class

// this is it
