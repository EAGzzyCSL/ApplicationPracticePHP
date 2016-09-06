<?php
/**
 * Created by PhpStorm.
 * User: 红印
 * Date: 2016/9/5
 * Time: 19:50
 */
header("Content-type: text/html;charset=utf-8;");
$array=null;
$result = mysqli_query($conn,"SELECT * FROM school");
if (!(mysqli_num_rows($result))){
    echo newjson(12,"不包括该学校",$array);
}else {
    $i=0;
    while($row = mysqli_fetch_array($result)){
        $array[$i]['ID']=$row['ID'];
        $array[$i]['name']=$row['name'];
        $i++;
    }
        $array[$i]['name']=$row['name'];
    echo newjson(13,"包含该学校",$array);
}
?>