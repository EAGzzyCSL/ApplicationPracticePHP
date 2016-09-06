<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2016/9/6
 * Time: 17:28
 */
header("Content-type: text/html;charset=utf-8;");
$array=NULL;
$name=$_POST['name'];
$address=$_POST['address'];
$image=$_POST['image'];
$school_ID=$_POST['school_ID'];
$rate=$_POST['rate'];
$sql = "INSERT INTO shop (name,address,image,school_ID,rate) VALUES ('$name','$address','$image','$school_ID','$rate')";
if (mysqli_query($conn,$sql)) {
    echo newjson(40,"添加餐馆成功",$array);
} else {
    echo newjson(24,"添加餐馆失败",$array);
}
?>