<?php
/**
 * Created by PhpStorm.
 * User: 红印
 * Date: 2016/9/6
 * Time: 16:17.
 */
$array = null;
$name = $_POST['name'];
$price = $_POST['price'];
$shop_ID = $_POST['shop_ID'];
$school_ID = $_POST['school_ID'];
$user_ID = $_POST['user_ID'];
$token = $_POST['token'];
$images = $_POST['images'];
$result = mysqli_query($conn, "SELECT * FROM token WHERE  token='$token' AND user_ID='$user_ID'");
if (!(mysqli_num_rows($result))) {
    echo newjson(18, 'token操作错误，拒绝服务', $array);
} else {
    $sql = "INSERT INTO goods (name, price, shop_ID,school_ID) VALUES ('$name','$price','$shop_ID','$school_ID')";
    $new = mysqli_query($conn, $sql);
    $goods_id = $conn->insert_id;
    if ($images != '') {
        $imageArray = explode(',', $images);
        foreach ($imageArray as $one_image) {
            mysqli_query($conn, "INSERT INTO `goods_image`(`goods_ID`, `url`) VALUES ('$goods_id','$one_image')");
        }
    }
    echo newjson(19, '操作成功', $array);
}
