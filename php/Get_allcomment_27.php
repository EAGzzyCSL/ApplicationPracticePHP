<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2016/9/9
 * Time: 15:22.
 */
header('Content-type: text/html;charset=utf-8;');
$array = null;
$user_ID = $_POST['user_ID'];
$token = $_POST['token'];
$result = mysqli_query($conn, "SELECT * FROM token WHERE  token='$token' AND user_ID='$user_ID'");
if (!(mysqli_num_rows($result))) {
    echo newjson(18, 'token操作错误或用户不存在，拒绝服务', $array);
} else {
    $result1 = mysqli_query($conn, "SELECT * FROM comment WHERE user_ID='$user_ID'");
    $i = 0;
    while ($row = mysqli_fetch_array($result1)) {
        $array[$i]['content'] = $row['content'];
        ++$i;
    }
    echo newjson(40, '获取用户所有评论成功', $array);
}
