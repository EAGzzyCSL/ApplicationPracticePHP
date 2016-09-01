<?php
// 接收七牛云的返回信息，其中有图片的地址
if (isset($_GET['upload_ret'])) {
    $upload_ret = $_GET['upload_ret'];
    echo base64_decode($upload_ret);
}
