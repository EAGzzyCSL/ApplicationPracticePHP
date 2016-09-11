<?php
/**
 * Created by PhpStorm.
 * User: 红印
 * Date: 2016/9/6
 * Time: 11:30.
 */
header('Content-type: text/html;charset=utf-8;');
$array = null;
$school_ID = $_POST['school_ID'];
$result = mysqli_query($conn, "SELECT * FROM goods WHERE  school_ID='$school_ID' ORDER by rate DESC limit 0,20");
if ($result == false || !(mysqli_num_rows($result))) {
    echo newjson(8, '无数据', $array);
} else {
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {
        //$row = mysqli_fetch_array($result)
        $array[$i]['ID'] = $row['ID'];
        $array[$i]['name'] = $row['name'];
        $array[$i]['price'] = $row['price'];
        $array[$i]['shop_ID'] = $row['shop_ID'];
        $array[$i]['school_ID'] = $row['school_ID'];
        $array[$i]['rate'] = $row['rate'];
        ++$i;
    }
    echo newjson(9, '显示前20项成功', $array);
}
