<?php
/**
 * Created by PhpStorm.
 * User: 红印
 * Date: 2016/9/6
 * Time: 17:57
 */
$array=null;
$user_ID = $_POST['user_ID'];
$comment_ID = $_POST['comment_ID'];
$token =$_POST['token'];
$result = mysqli_query($conn,"SELECT * FROM praise WHERE  user_ID='$user_ID' AND comment_ID='$comment_ID'");
if(!(mysqli_num_rows($result))){
    $result = mysqli_query($conn,"SELECT * FROM token WHERE  token='$token' AND user_ID='$user_ID'");
    if(!(mysqli_num_rows($result))){
        echo newjson(18,"token操作错误，拒绝服务",$array);
    }else{
        $sql = "INSERT INTO praise (comment_ID, user_ID) VALUES ('$comment_ID','$user_ID')";
        $sql1 = "SELECT like_num FROM pinglun WHERE  ID='$comment_ID'";
        $result = mysqli_query($conn,$sql1);
        $row = mysqli_fetch_array($result);
        $num = $row['like_num']+1;
        $sql1 = "UPDATE pinglun SET like_num='$num' WHERE ID='$comment_ID'";
        $result = mysqli_query($conn,$sql1);
        $new=mysqli_query($conn,$sql);
        if($new && $result) echo newjson(25,"点赞成功",$array);
        else echo newjson(26,"点赞失败",$array);

    }
}else{
    echo newjson(27,"您已点赞过此评论",$array);
}

?>