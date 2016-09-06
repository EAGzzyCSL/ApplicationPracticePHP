<?php
session_start();

require "jsonHelper.php";
require "connectSql.php";

$PostType = $_GET['PostType'];

switch ($PostType) {
    case "register_1":
        require "register_1.php";
        break;
}

mysqli_close($conn);
?>