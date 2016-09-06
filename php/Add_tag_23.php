<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2016/9/6
 * Time: 16:42
 */
header("Content-type: text/html;charset=utf-8;");
$array=null;
$ID=$_GET['ID'];
$name=$_GET['name'];
$sql = "INSERT INTO tag (ID, name) VALUES ('$ID','$name')";
if (mysqli_query($conn,$sql)) {
    echo "新标签添加成功";
} else {
    echo newjson(21,"添加标签失败",$array);
}
?>

