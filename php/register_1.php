<?php
/**
 * Created by PhpStorm.
 * User: 红印
 * Date: 2016/9/4
 * Time: 22:12
 */
//mysqli_query($conn,"set names utf8");
header("Content-type: text/html;charset=utf-8;");
$array=null;
$name=$_GET['name'];
$password=$_GET['password'];
//$sql="UPDATE Course SET C_Time='$c',C_Student='$b' WHERE C_ID='$cha'";
$result = mysqli_query($conn,"SELECT * FROM user WHERE name='$name'");
if(!(mysqli_num_rows($result))){
    $sql = "INSERT INTO user (name, password) VALUES ('$name','$password')";
    if (mysqli_query($conn,$sql)) {
        echo newjson(1,"注册成功",$array);//"新记录插入成功";
    } else {
        echo newjson(2,"插入数据失败,注册失败",$array);
    }
}
else{
    echo newjson(3,"用户名重复",$array);
}
?>