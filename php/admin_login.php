<?php
/**
 * Created by PhpStorm.
 * User: 红印
 * Date: 2016/9/5
 * Time: 19:33
 */
header("Content-type: text/html;charset=utf-8;");
$array=null;
$name=$_GET['name'];
$password=$_GET['password'];
$result = mysqli_query($conn,"SELECT * FROM admin WHERE name='$name'");
if(!(mysqli_num_rows($result))){
    echo newjson(7,"用户名或密码错误",$array);
}else echo newjson(8,"登陆成功",$array);
?>