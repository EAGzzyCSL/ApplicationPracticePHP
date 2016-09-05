<?php
/**
 * Created by PhpStorm.
 * User: 红印
 * Date: 2016/9/5
 * Time: 11:22
 */
header("Content-type: text/html;charset=utf-8;");
$array=null;
$name=$_GET['nam'];
$password=$_GET['password'];
$result = mysqli_query($conn,"SELECT * FROM user WHERE nam='$name' AND password='$password'");
if(!(mysqli_num_rows($result))){
    echo newjson(4,"账号或密码错误",$array);
}else{
    $number=create_unique();
    $row = mysqli_fetch_array($result);
    $sql = "INSERT INTO token (user_ID, token) VALUES ('$row[ID]','$number')";
    if (mysqli_query($conn,$sql)) {
        $array['ID']=$row['ID'];
        $array['nam']=$row['nam'];
        $array['password']=$row['password'];
        $array['token']=$number;
        echo newjson(1,"登录成功",$array);//"新记录插入成功";
    } else {
        echo newjson(2,"插入数据失败",$array);
    }
}

?>