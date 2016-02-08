<?php
function module_api_naver_ping($ping_url) {

    include_once(CONFIG_PATH . 'custom.php');

    $ping_auth_header = "Authorization:" . $CUSTOM['naver_api_key_syndi'];

    $ping_client_opt = array(
        CURLOPT_URL => "https://apis.naver.com/crawl/nsyndi/v2",
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => "ping_url=" . $ping_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_HTTPHEADER => array("Host: apis.naver.com", "Pragma: no-cache", "Accept: */*", $ping_auth_header)
    );

    $ping = curl_init();
    curl_setopt_array($ping, $ping_client_opt);
    $result = curl_exec($ping);
    curl_close($ping);

    return $result;
}

// end of file
