<?php
/**
 * Created by PhpStorm.
 * User: 红印
 * Date: 2016/8/31
 * Time: 21:40
 */
//header("Content-type: text/html;charset=utf-8;");
$a=$_GET['C_Name'];
$a1=$_GET['C_Type'];
$a2=$_GET['C_Student'];
$a3=$_GET['C_Time'];
$a4=$_GET['C_Teacher'];
$a5=$_GET['C_ID'];
$a6=$_GET['C_Remark'];
$sql = "INSERT INTO Course (C_Name, C_Type, C_Student,C_Time,C_Teacher,C_ID,C_Remark) VALUES ('$a','$a1','$a2','$a3','$a4','$a5','$a6')";
if (mysqli_query($conn,$sql)) {
    echo "新记录插入成功";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>