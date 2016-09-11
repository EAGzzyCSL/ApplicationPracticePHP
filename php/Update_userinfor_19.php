<?php
/**
 * Created by PhpStorm.
 * User: 红印
 * Date: 2016/9/6
 * Time: 22:08.
 */
$array = null;
$ID = $_POST['ID'];
$name = $_POST['name'];
$sex = $_POST['sex'];
$native = $_POST['native'];
$tel = $_POST['tel'];
$email = $_POST['email'];
$birth = $_POST['birth'];
$avatar = $_POST['avatar'];
$sql_update = "UPDATE user_infor SET name='$name',sex='$sex',native='$native',tel='$tel',email='$email',birth='$birth',`avatar`='$avatar' WHERE ID='$ID'";
$sql_insert = "INSERT INTO `user_infor`(`ID`, `name`, `sex`, `native`, `tel`, `email`, `birth`, `avatar`) VALUES ('$ID','$name','$sex','$native','$tel','$email','$birth','$avatar')";
$result_check_exits = mysqli_query($conn, "select * from `user_infor` where `ID`='$ID'");
if ($result_check_exits !== false && mysqli_num_rows($result_check_exits)) {
    $sql = $sql_update;
} else {
    $sql = $sql_insert;
}
if (mysqli_query($conn, $sql)) {
    echo newjson(35, '更新数据成功', $array);
} else {
    echo newjson(36, '更新数据失败', $array);
}
