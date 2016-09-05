<?php
/**
 * Created by PhpStorm.
 * User: 红印
 * Date: 2016/9/5
 * Time: 19:14
 */
header("Content-type: text/html;charset=utf-8;");
$array=null;
$user_ID=$_GET['user_ID'];
$token=$_GET['token'];
$result = mysqli_query($conn,"SELECT * FROM token WHERE token='$token' AND user_ID='$user_ID'");
if(!(mysqli_num_rows($result))){
    echo newjson(5,"token不存在",$array);
}else{
    echo newjson(6,"token存在",$array);
}
?>