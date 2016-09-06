<?php
/**
 * Created by PhpStorm.
 * User: 红印
 * Date: 2016/8/31
 * Time: 21:36
 */

$result = mysqli_query($conn,"SELECT * FROM course");
if( $result == null){
    echo "无数据";
}

else{
    $array;
    $i=0;
    while($row = mysqli_fetch_array($result)){//$row = mysqli_fetch_array($result)
        $array[$i]['C_Name']=$row['C_Name'];
        $array[$i]['C_Type']=$row['C_Type'];
        $array[$i]['C_Student']=$row['C_Student'];
        $array[$i]['C_Time']=$row['C_Time'];
        $array[$i]['C_Teacher']=$row['C_Teacher'];
        $array[$i]['C_ID']=$row['C_ID'];
        $array[$i]['C_Remark']=$row['C_Remark'];
        $i++;
    }
   // echo JSON($array);
    echo newjson(200,"错误",$array);
}

$sql = "SELECT * FROM course";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // 输出每行数据
    while($row = $result->fetch_assoc()) {
        echo "<br> C_Name: ". $row["C_Name"]. " -C_Type: ". $row["C_Type"]. " -C_Student: ". $row["C_Student"]. " -C_Time: ". $row["C_Time"]. " -C_Teacher: ". $row["C_Teacher"]. " -C_ID: ". $row["C_ID"]. " -C_Remark: ". $row["C_Remark"];
    }
} else {
    echo "0 个结果";
}

?>