<?php
/**
 * Created by PhpStorm.
 * User: 红印
 * Date: 2016/9/6
 * Time: 23:09
 */
$array=null;
$user_ID=$_POST['user_ID'];
$token=$_POST['token'];
$comment_ID = $_POST['comment_ID'];
$result = mysqli_query($conn,"SELECT * FROM token WHERE  token='$token' AND user_ID='$user_ID'");
if(!(mysqli_num_rows($result))){
    echo newjson(18,"token操作错误，拒绝服务",$array);
}else{
    $sql="DELETE FROM praise WHERE comment_ID='$comment_ID' AND user_ID='$user_ID'";
    if (mysqli_query($conn,$sql)) {
        echo newjson(43,"删除点赞成功",$array);
    } else {
        echo newjson(44,"删除点赞失败",$array);
    }
}
?>