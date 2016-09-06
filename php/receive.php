<?php
session_start();

require "jsonHelper.php";
require "connectSql.php";

$PostType = $_GET['PostType'];

switch ($PostType) {
    case "register":
        require "register_1.php";
        break;
    case "login":
        require "login_2.php";
        break;
}

mysqli_close($conn);
?>