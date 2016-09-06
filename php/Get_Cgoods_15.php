<?php
/**
 * Created by PhpStorm.
 * User: 红印
 * Date: 2016/9/6
 * Time: 19:57
 */
$array=null;
$user_ID=$_POST['user_ID'];
$token=$_POST['token'];
$result = mysqli_query($conn,"SELECT * FROM token WHERE  token='$token' AND user_ID='$user_ID'");
if(!(mysqli_num_rows($result))){
    echo newjson(18,"token操作错误，拒绝服务",$array);
}else{
    $result = mysqli_query($conn,"SELECT * FROM goods where ID IN (SELECT goods_ID FROM comment where user_ID='$user_ID')");
    if(!(mysqli_num_rows($result))){
        echo newjson(10,"没有有关的数据",$array);
    }else {
        $i = 0;
        while ($row = mysqli_fetch_array($result)) {//$row = mysqli_fetch_array($result)
            $array[$i]['ID'] = $row['ID'];
            $array[$i]['name'] = $row['name'];
            $array[$i]['price'] = $row['price'];
            $array[$i]['shop_ID'] = $row['shop_ID'];
            $array[$i]['school_ID'] = $row['school_ID'];
            $array[$i]['rate'] = $row['rate'];
            $i++;
        }
        echo newjson(11,"搜索成功",$array);
    }
}
?>