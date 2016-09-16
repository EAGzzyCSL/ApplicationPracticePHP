<?php
/**
 * Created by PhpStorm.
 * User: 红印
 * Date: 2016/9/6
 * Time: 16:17.
 */
$array = null;
$goods_ID = $_POST['goods_ID'];
$content = $_POST['content'];
$rate = $_POST['rate'];
$user_ID = $_POST['user_ID'];
$token = $_POST['token'];
$images = $_POST['images'];
$result = mysqli_query($conn, "SELECT * FROM token WHERE  token='$token' AND user_ID='$user_ID'");
if (!(mysqli_num_rows($result))) {
    echo newjson(18, 'token操作错误，拒绝服务', $array);
} else {
    $date = date('Y-m-d H:i:s', time());
    $sql = "INSERT INTO pinglun (user_ID, goods_ID, content,rate,time) VALUES ('$user_ID','$goods_ID','$content','$rate','$date')";
    $new = mysqli_query($conn, $sql);
    $comment_id = $conn->insert_id;
    $imageArray = explode(',', $images);
    if ($images != '') {
        foreach ($imageArray as $one_image) {
            mysqli_query($conn, "INSERT INTO `comment_image`( `comment_ID`, `url`) VALUES ('$comment_id','$one_image')");
        }
    }
    if ($new) {
        echo newjson(24, '添加评论成功', $array);
    } else {
        echo newjson(23, '添加评论失败', $array);
    }
}
