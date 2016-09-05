<?php
/**
 * Created by PhpStorm.
 * User: 红印
 * Date: 2016/9/1
 * Time: 18:54
 */

$cha=$_GET['C_ID'];
$sql="DELETE FROM Course WHERE C_ID='$cha'";
//mysqli_query($conn,"DELETE FROM Course WHERE C_ID='$cha'");
//mysqli_query($conn,$sql);
if(mysqli_query($conn,$sql)){
    echo "<br>删除成功";
}
?>