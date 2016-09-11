<?php
/**
 * Created by PhpStorm.
 * User: 红印
 * Date: 2016/9/5
 * Time: 11:22.
 */
header('Content-type: text/html;charset=utf-8;');
$array = null;
$name = $_POST['name'];
$password = $_POST['password'];
$result = mysqli_query($conn, "SELECT * FROM user WHERE name='$name' AND password='$password'");
if (!(mysqli_num_rows($result))) {
    echo newjson(4, '账号或密码错误', $array);
} else {
    $number = create_unique();
    $row = mysqli_fetch_array($result);
    $result1 = mysqli_query($conn, 'SELECT * FROM token WHERE user_ID='.$row['ID']);
    if (!(mysqli_num_rows($result1))) {
        $sql = "INSERT INTO token (user_ID, token) VALUES ('$row[ID]','$number')";
    } else {
        $sql = "UPDATE token SET token='$number' WHERE user_ID='$row[ID]'";
    }
    if (mysqli_query($conn, $sql)) {
        $array['ID'] = $row['ID'];
        $array['name'] = $row['name'];
        $array['token'] = $number;
        $ID = $row['ID'];
        $result_avatar = mysqli_query($conn, "SELECT `avatar` FROM `user_infor` WHERE `ID`=$ID");
        if ($result_avatar !== false && mysqli_num_rows($result_avatar)) {
            $array['avatar'] = mysqli_fetch_array($result_avatar)['avatar'];
        } else {
            $array['avatar'] = '';
        }
        echo newjson(1, '登录成功', $array); //"新记录插入成功";
    } else {
        echo newjson(2, '插入数据失败', $array);
    }
}
