<?php
if(!defined("__MAPC__")) { exit(); }
include PROC_PATH . 'proc.autoload.php';

use Mapc\oAuth\oAuth;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\GenericProvider;


// # oAuth 로그인
if (!isset($_GET['code']) && $_REQUEST['mode'] == "login") {
    $root_url = oAuth::getUrl();
    $clientInfo = oAuth::clientInfo($_POST);

    $clientId = $clientInfo['clientId'];
    $clientSecret = $clientInfo['clientSecret'];
    $redirectUri = $clientInfo['redirectUri'];

    $provider = new GenericProvider([
        'clientId'                => $clientId,    // The client ID assigned to you by the provider
        'clientSecret'            => $clientSecret,   // The client password assigned to you by the provider
        'redirectUri'             => $redirectUri,
        'urlAuthorize'            => $root_url . 'oAuth/authorize',
        'urlAccessToken'          => $root_url . 'oAuth/token',
        'urlResourceOwnerDetails' => $root_url . 'oAuth/resource'
    ]);

    $authorizationUrl = $provider->getAuthorizationUrl();

    $_SESSION['oauth2state'] = $provider->getState();

    // # 1. authorization token 발급
    // http://localhost/authorize.php?response_type=code&client_id=testclient&state=xyz
    try {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $authorizationUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $data = curl_exec($ch);

        $result = json_decode($data, true);
        if ($result['status'] === false) {
            print_r($result);echo 'Error';
            throw new Exception(curl_error($ch), curl_errno($ch));
            exit;
        }
    } catch(Exception $e) {
        trigger_error(sprintf(
            'Curl failed with error #%d: %s',
            $e->getCode(), $e->getMessage()),
            E_USER_ERROR);
    }

    // # 2. access_token 발급
    $code = $result['code'];
    try {
        $accessToken = $provider->getAccessToken('authorization_code', [
            'code' => $code
        ]);

        /*echo 'Access Token: ' . $accessToken->getToken() . "<br>";
        echo 'Refresh Token: ' . $accessToken->getRefreshToken() . "<br>";
        echo 'Expired in: ' . $accessToken->getExpires() . "<br>";
        echo 'Already expired? ' . ($accessToken->hasExpired() ? 'expired' : 'not expired') . "<br>";

        $resourceOwner = $provider->getResourceOwner($accessToken);

        var_export($resourceOwner->toArray());

        $request = $provider->getAuthenticatedRequest(
            'GET',
            'http://brentertainment.com/oauth2/lockdin/resource',
            $accessToken
        );*/

        $access_token = $accessToken->getToken();

    } catch (IdentityProviderException $e) {
        exit($e->getMessage());
    }

    // # 3. login session 생성
    if (!empty($access_token)) {
        $userInfos = oAuth::getUserInfos($clientId);

        if ($userInfos == false) {
            // userInfos 오류 났을때
            echo "userInfos Error!";
            exit;
        }

        session_start();
        $_SESSION['isLogin'] = true;
        $_SESSION['access_token'] = $access_token;
        $_SESSION['userInfos'] = $userInfos;

        // 임시로 로그아웃 화면으로
        header('Location: ' . $v['url']['oAuthServer'] . 'oAuth/client/logout');
        exit;
    }
} else if ($_REQUEST['mode'] == "logout") {
    // # oAuth 로그아웃
    $result = oAuth::logout();

    if ($result == false) {
        echo "logout Error!";
        exit;
    }

    header('Location: ' . $v['url']['oAuthServer']);
    exit;
}