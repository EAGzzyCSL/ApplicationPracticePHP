<?php
/**
 * Created by PhpStorm.
 * User: 红印
 * Date: 2016/9/6
 * Time: 22:44
 */
$array=null;
$follow_ER=$_POST['follow_ER'];
$follow_EE=$_POST['follow_EE'];
$token=$_POST['token'];
$result = mysqli_query($conn,"SELECT * FROM token WHERE  token='$token' AND user_ID='$follow_ER'");
if(!(mysqli_num_rows($result))){
    echo newjson(18,"token操作错误，拒绝服务",$array);
}else{
    $sql = "INSERT INTO friend (follow_ER,follow_EE) VALUES ('$follow_ER','$follow_EE')";
    if (mysqli_query($conn,$sql)) {
        echo newjson(38,"添加好友成功",$array);
    } else {
        echo newjson(39,"添加好友失败",$array);
    }
}
?>