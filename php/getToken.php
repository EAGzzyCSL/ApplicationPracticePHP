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

    return $auth->uploadToken($bucket);
}
echo getToken();
