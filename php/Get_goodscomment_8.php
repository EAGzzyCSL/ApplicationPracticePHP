<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2016/9/6
 * Time: 14:07
 */
header("Content-type: text/html;charset=utf-8;");
$array=null;
$goods_ID=$_POST['goods_ID'];
$result = mysqli_query($conn,"SELECT * FROM comment WHERE goods_ID='$goods_ID'");
if(!(mysqli_num_rows($result))){
    echo newjson(14,"对不起，没有您想要的菜",$array);
}   else {
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {
        $array[$i]['ID'] = $row['ID'];
        $array[$i]['user_ID'] = $row['user_ID'];
        $result1 = mysqli_query($conn,"SELECT * FROM user WHERE  ID=".$row['user_ID']);
        $row1 = mysqli_fetch_array($result1);
        $array[$i]['name']=$row1['name'];
        $array[$i]['goods_ID'] = $row['goods_ID'];
        $array[$i]['content'] = $row['content'];
        $array[$i]['rate'] = $row['rate'];
        $array[$i]['time'] = $row['time'];
        $i++;
    }
    echo newjson(15,"查询成功",$array);
}
    ?>