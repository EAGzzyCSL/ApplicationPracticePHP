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
    while ($row = mysqli_fetch_array($result1)) {
        $array['ID'] = $row['ID'];
        $array['name'] = $row['name'];
        $array['sex'] = $row['sex'];
        $array['dormitory'] = $row['native'];
        $array['tel'] = $row['tel'];
        $array['email'] = $row['email'];
        $array['birth'] = $row['birth'];
    }
    echo newjson(28, "获取用户详情成功", $array);
}
?>