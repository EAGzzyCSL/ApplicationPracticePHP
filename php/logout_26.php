<?php
/**
 * Created by PhpStorm.
 * User: 红印
 * Date: 2016/9/7
 * Time: 8:43
 */
$array=null;
$user_ID=$_POST['user_ID'];
$token=$_POST['token'];
$sql="DELETE FROM token WHERE token='$token' AND user_ID='$user_ID'";
if (mysqli_query($conn,$sql)) {
    echo newjson(45,"注销成功",$array);
} else {
    echo newjson(46,"注销失败",$array);
}
?>