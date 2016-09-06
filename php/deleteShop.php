<?php

require '_db_con.php';
$id = $_POST['id'];
$stmt = $db_con->prepare('delete  FROM `shop` WHERE `ID`=?');
$stmt->bind_param('i', $id);
$stmt->execute();

$stmt->close();
header('location:../manager.php');
