<?php
/**
 * Created by PhpStorm.
 * User: 红印
 * Date: 2016/9/6
 * Time: 21:26
 */
$array=null;
$user_ID=$_POST['user_ID'];
$token=$_POST['token'];
$goods_ID=$_POST['goods_ID'];
$result = mysqli_query($conn,"SELECT * FROM token WHERE  token='$token' AND user_ID='$user_ID'");
if(!(mysqli_num_rows($result))){
    echo newjson(18,"token操作错误，拒绝服务",$array);
}else{
    $result = mysqli_query($conn,"SELECT * FROM collection WHERE  user_ID='$user_ID' AND goods_ID='$goods_ID'");
    if(!(mysqli_num_rows($result))){
        echo newjson(33,"未收藏",$array);
    }else{
        echo newjson(34,"已收藏",$array);
    }
}


?>