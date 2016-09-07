<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2016/9/6
 * Time: 16:09
 */
header("Content-type: text/html;charset=utf-8;");
$array=null;
$result = mysqli_query($conn,"SELECT * FROM tag ");
$i = 0;
while ($row = mysqli_fetch_array($result)) {
    $array[$i]['ID'] = $row['ID'];
    $array[$i]['name'] = $row['name'];
    $i++;
}
    echo newjson(20, "标签信息", $array);
?>

