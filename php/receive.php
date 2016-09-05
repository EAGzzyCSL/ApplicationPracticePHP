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
    case "check_token":
        require "check_token.php";
        break;
    case "admin_login":
        require "admin_login.php";
        break;
    case "Get_school":
        require "Get_school.php";
        break;
}

mysqli_close($conn);
?>