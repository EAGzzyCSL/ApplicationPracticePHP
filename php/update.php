<?php
/**
 * Created by PhpStorm.
 * User: 红印
 * Date: 2016/9/1
 * Time: 19:08
 */
mysqli_query($conn,"set names utf8");
$cha=$_GET['C_ID'];
$b=$_GET['C_Student'];
$c=$_GET['C_Time'];
$sql="UPDATE Course SET C_Time='$c',C_Student='$b' WHERE C_ID='$cha'";
//mysqli_query($con,"UPDATE Persons SET Age=36
//WHERE FirstName='Peter' AND LastName='Griffin'");
if(mysqli_query($conn,$sql)){
    echo "<br>update success!";
}
?>