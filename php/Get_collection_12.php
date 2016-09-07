<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2016/9/6
 * Time: 15:32
 */
header("Content-type: text/html;charset=utf-8;");
$array=null;
$user_ID=$_POST['user_ID'];
$result = mysqli_query($conn,"SELECT * FROM collection WHERE user_ID='$user_ID'");
if(!(mysqli_num_rows($result))){
    echo newjson(16,"账号不存在，请注册",$array);
}   else {
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {
        $array[$i]['goods_ID'] = $row['goods_ID'];
        $array[$i]['user_ID'] = $row['user_ID'];
        $i++;
        echo newjson(17, "获取收藏成功", $array);
    }
}
?>