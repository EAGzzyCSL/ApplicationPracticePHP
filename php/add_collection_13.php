<?php
/**
 * Created by PhpStorm.
 * User: 红印
 * Date: 2016/9/6
 * Time: 22:58
 */
$array=null;
$user_ID=$_POST['user_ID'];
$token=$_POST['token'];
$goods_ID=$_POST['goods_ID'];
$result = mysqli_query($conn,"SELECT * FROM token WHERE  token='$token' AND user_ID='$user_ID'");
if(!(mysqli_num_rows($result))){
    echo newjson(18,"token操作错误，拒绝服务",$array);
}else{
    $sql = "INSERT INTO collection (goods_ID,user_ID) VALUES ('$goods_ID','$user_ID')";
    if (mysqli_query($conn,$sql)) {
        echo newjson(41,"收藏成功",$array);
    } else {
        echo newjson(42,"收藏失败",$array);
    }
}
?>