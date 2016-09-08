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
$result = mysqli_query($conn,"SELECT * FROM goods where ID IN (SELECT goods_ID FROM collection where user_ID='$user_ID')");
if(!(mysqli_num_rows($result))){
    echo newjson(16,"获取收藏失败",$array);
}   else {
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
        echo newjson(17, "获取收藏成功", $array);

}
?>