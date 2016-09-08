<?php

if (isset($_POST['schoolName'])) {
    $schoolName = $_POST['schoolName'];
    // 查询数据库如果有该学校的话不再添加
    require '_db_con.php';
    $stmt = $db_con->prepare('SELECT * FROM `school` WHERE `name`=?');
    $stmt->bind_param('s', $schoolName);
    $stmt->execute();
    if (!$stmt->fetch()) {
        $stmt->close();
        $stmt = $db_con->prepare('INSERT INTO `school`(`name`) VALUES (?)');
        $stmt->bind_param('s', $schoolName);
        $stmt->execute();
    }
}
header('location:../manager.php');
