<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2016/9/6
 * Time: 18:04
 */
header("Content-type: text/html;charset=utf-8;");
$array=null;
$user_ID=$_POST['user_ID'];
$token=$_POST['token'];
$result = mysqli_query($conn,"SELECT * FROM token WHERE  token='$token' AND user_ID='$user_ID'");
if(!(mysqli_num_rows($result))){
    echo newjson(18,"token操作错误，拒绝服务",$array);
}else {
    $result1 = mysqli_query($conn, "SELECT * FROM user_infor WHERE ID='$user_ID'");
    $i = 0;
    while ($row = mysqli_fetch_array($result1)) {
        $array[$i]['ID'] = $row['ID'];
        $array[$i]['name'] = $row['name'];
        $array[$i]['sex'] = $row['sex'];
        $array[$i]['native'] = $row['native'];
        $array[$i]['tel'] = $row['tel'];
        $array[$i]['email'] = $row['email'];
        $array[$i]['birth'] = $row['birth'];
        $i++;
    }
    echo newjson(28, "获取用户详情成功", $array);
}
?>