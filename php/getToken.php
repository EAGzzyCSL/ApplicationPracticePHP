<?php

require '../vendor/autoload.php';
use Qiniu\Auth;

function getToken()
{
    require '../php/config.php';
    $bucket = $config['bucket'];
    $accessKey = $config['accessKey'];
    $secretKey = $config['secretKey'];

    $auth = new Auth($accessKey, $secretKey);
    $policy = array(
    );
    $upToken = $auth->uploadToken($bucket, null, 3600, $policy);

    return $upToken;
}
echo getToken();
