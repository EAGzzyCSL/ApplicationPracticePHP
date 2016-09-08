<?php
// 接收七牛云的返回信息，其中有图片的地址
require 'config.php';
if (isset($_GET['upload_ret'])) {
    $upload_ret = $_GET['upload_ret'];
    // url安全的base64编码方式
    $base64 = base64_decode(strtr($upload_ret, '-_',  '+/'));
    // echo $base64;
    $json = json_decode($base64);
    // echo var_dump($json);
    require '_db_con.php';
    $stmt = $db_con->prepare('INSERT INTO `shop`(`name`, `address`, `image`, `school_ID`) VALUES (?,?,?,?)');
    $stmt->bind_param('sssi', $json->canteen_name, $json->canteen_address, $imgUrl, $json->canteen_school);
    $imgUrl = $config['bucket_host'].$json->key;
    $stmt->execute();
    $stmt->close();
    header('location:../manager.php');
}
