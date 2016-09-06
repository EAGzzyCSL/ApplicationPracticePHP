<?php
/**
 * Created by PhpStorm.
 * User: 红印
 * Date: 2016/9/6
 * Time: 16:17
 */
$array=null;
$name = $_POST['name'];
$price = $_POST['price'];
$shop_ID = $_POST['shop_ID'];
$school_ID = $_POST['school_ID'];
$rate = $_POST['rate'];
$user_ID=$_POST['user_ID'];
$token=$_POST['token'];
$result = mysqli_query($conn,"SELECT * FROM token WHERE  token='$token' AND user_ID='$user_ID'");
if(!(mysqli_num_rows($result))){
    echo newjson(18,"token操作错误，拒绝服务",$array);
}else{
    $sql = "INSERT INTO goods (name, price, shop_ID,school_ID,rate) VALUES ('$name','$price','$shop_ID','$school_ID','$rate')";
    $new=mysqli_query($conn,$sql);
    echo newjson(19,"操作成功",$array);
}
?>