<?php
/**
 * Created by PhpStorm.
 * User: 红印
 * Date: 2016/9/5
 * Time: 19:14
 */
header("Content-type: text/html;charset=utf-8;");
$array=null;
$user_ID=$_POST['user_ID'];
$token=$_POST['token'];
$result = mysqli_query($conn,"SELECT * FROM token WHERE token='$token' AND user_ID='$user_ID'");
if(!(mysqli_num_rows($result))){
    echo newjson(4,"token不存在",$array);
}else{
    $result = mysqli_query($conn,"SELECT * FROM user WHERE ID='$user_ID'");
    $row = mysqli_fetch_array($result);
    $array['ID']=$row['ID'];
    $array['name']=$row['name'];
    $array['token']=$token;
    echo newjson(5,"token存在",$array);
}
?>