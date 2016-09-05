<?php
session_start();

require "jsonHelper.php";
require "connectSql.php";

$PostType = $_GET['PostType'];

switch ($PostType) {
    case "Course":
        require "Course.php";
        break;
    case "show":
        require "show.php";
        break;
    case "add":
        require "add.php";
        break;
    case "delete":
        require "delete.php";
        break;
    case "update":
        require "update.php";
        break;
    case "login":
        require "login.php";
        break;
    case "register":
        require "register.php";
        break;
    case "login_1":
        require "login_1.php";
        break;
}

mysqli_close($conn);
?>