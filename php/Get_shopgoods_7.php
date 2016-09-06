<?php
/**
 * Created by PhpStorm.
 * User: 红印
 * Date: 2016/9/6
 * Time: 16:05
 */
header("Content-type: text/html;charset=utf-8;");
$array=null;
$shop_ID=$_POST['shop_ID'];
$result = mysqli_query($conn,"SELECT * FROM goods WHERE  shop_ID='$shop_ID'");
if(!(mysqli_num_rows($result))){
    echo newjson(8,"无数据",$array);
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
    echo newjson(18,"获取成功",$array);
}
?>